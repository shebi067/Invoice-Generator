function invoiceBuilderApp() {
    return {
        blocks: [], selectedId: null, paletteOpen: false, currency: '$', downloadFormat: 'pdf', isGenerating: false, isPrinting: false, error: '',
        availableBoxTypes: [
            ['logo','Logo'],['company','Company Name'],['title','Title'],['date','Date'],['number','Invoice Number'],['qr','Custom QR Code'],['heading','Heading'],['text','Text'],['label','Label & Field'],['field','Input Field'],['empty','Empty Box'],['table','Item Bar'],['separator','Separator Line'],['notes','Notes'],['terms','Terms'],['address','Address'],['summary','Checkout / Totals']
        ].map(([type,label]) => ({type,label})),
        summaryRows: [
            {key:'subtotal',label:'Subtotal'}, {key:'tax',label:'Tax (%)'},
            {key:'discount',label:'Discount'}, {key:'shipping',label:'Shipping'},
            {key:'total',label:'Total'}, {key:'paid',label:'Amount Paid'},
            {key:'balance',label:'Balance Due'}
        ],
        currencies: [
            {symbol:'$',label:'USD ($)'},
            {symbol:'Rs. ',label:'PKR (Rs.)'}, {symbol:'\u20b9',label:'INR (\u20b9)'},
            {symbol:'\u20ac',label:'EUR (\u20ac)'}, {symbol:'\u00a3',label:'GBP (\u00a3)'},
            {symbol:'AED ',label:'AED (د.إ)'}, {symbol:'C$',label:'CAD ($)'}, {symbol:'A$',label:'AUD ($)'}
        ],
        get currencyLabel() {
            const found = this.currencies.find(c => c.symbol === this.currency);
            return found ? found.label : (this.currency || 'USD ($)');
        },
        initBuilder() {
            try {
                const saved = localStorage.getItem('invoice_builder_draft');
                if (saved) {
                    const parsed = JSON.parse(saved);
                    if (parsed && Array.isArray(parsed.blocks) && parsed.blocks.length > 0) {
                        this.blocks = parsed.blocks;
                        if (parsed.currency) this.currency = parsed.currency;
                        if (parsed.downloadFormat) this.downloadFormat = parsed.downloadFormat;
                    }
                }
            } catch (e) {
                console.error('Error loading builder draft:', e);
            }

            this.$watch('blocks', () => this.saveToStorage(), { deep: true });
            this.$watch('currency', () => this.saveToStorage());
            this.$watch('downloadFormat', () => this.saveToStorage());

            this.autoSaveHandler = () => this.saveToStorage();
            window.addEventListener('input', this.autoSaveHandler);
            window.addEventListener('change', this.autoSaveHandler);
            window.addEventListener('beforeunload', this.autoSaveHandler);

            this.printShortcut = event => {
                if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 'p') {
                    event.preventDefault(); this.printInvoice();
                }
            };
            window.addEventListener('keydown', this.printShortcut);
        },
        destroy() {
            window.removeEventListener('keydown', this.printShortcut);
            if (this.autoSaveHandler) {
                window.removeEventListener('input', this.autoSaveHandler);
                window.removeEventListener('change', this.autoSaveHandler);
                window.removeEventListener('beforeunload', this.autoSaveHandler);
            }
        },
        saveToStorage() {
            try {
                localStorage.setItem('invoice_builder_draft', JSON.stringify({
                    blocks: this.blocks,
                    currency: this.currency,
                    downloadFormat: this.downloadFormat
                }));
            } catch (e) {}
        },
        clearAll() {
            this.blocks = [];
            this.selectedId = null;
            try {
                localStorage.removeItem('invoice_builder_draft');
            } catch (e) {}
        },
        localDate() {
            const d = new Date();
            return [d.getFullYear(), String(d.getMonth()+1).padStart(2,'0'), String(d.getDate()).padStart(2,'0')].join('-');
        },
        formattedDate(b) {
            if (!/^\d{4}-\d{2}-\d{2}$/.test(b.content)) return '';
            const [year, month, day] = b.content.split('-');
            const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
            switch (b.dateFormat) {
                case 'DD/MM/YYYY': return `${day}/${month}/${year}`;
                case 'MM/DD/YYYY': return `${month}/${day}/${year}`;
                case 'DD-MM-YYYY': return `${day}-${month}-${year}`;
                case 'D MMM YYYY': return `${Number(day)} ${months[Number(month)-1]?.slice(0,3)} ${year}`;
                case 'MMMM D, YYYY': return `${months[Number(month)-1]} ${Number(day)}, ${year}`;
                default: return b.content;
            }
        },
        fieldLineStyle(b) {
            return {width: this.clamp(b.lineWidth, 1, 900)+'px', borderBottom: this.clamp(b.lineThickness,0,12)+'px '+b.lineStyle+' '+b.lineColor};
        },
        get selected() { return this.blocks.find(b => b.id === this.selectedId) || null; },
        getBlockLabel(type) { return this.availableBoxTypes.find(b => b.type === type)?.label || 'Box'; },
        id() { return 'b' + Math.random().toString(36).slice(2) + Date.now(); },
        clamp(value, min, max) { return Math.max(min, Math.min(max, Number(value) || min)); },
        positive(value) { return Math.max(0, Number(value) || 0); },
        minWidth(b) { return b.type === 'logo' && b.aspectRatio ? 1 : b.type === 'table' ? 460 : b.type === 'summary' ? 260 : 60; },
        constrain(b, axis = 'width') {
            if (b.type === 'logo' && b.aspectRatio > 0) {
                const width = axis === 'height' ? Number(b.h) * b.aspectRatio : b.w;
                b.w = this.clamp(width, Math.min(1, 1273 * b.aspectRatio), Math.min(900, 1273 * b.aspectRatio));
                b.h = b.w / b.aspectRatio;
            } else {
                b.w = this.clamp(b.w, this.minWidth(b), 900);
                b.h = this.clamp(b.h, 36, 1273);
            }
            b.x = this.clamp(b.x, 0, 900 - b.w);
            b.y = this.clamp(b.y, 0, 1273 - b.h);
        },
        addBlock(type, x, y) {
            if (!this.availableBoxTypes.some(b => b.type === type)) return;
            const content = {company:'Business Name',title:'INVOICE',date:this.localDate(),number:'#INV-001',heading:'Heading',text:'Text',label:'',field:'',empty:'',notes:'',terms:'',address:''};
            const b = {id:this.id(),type,x:x ?? 60+(this.blocks.length%4)*18,y:y ?? 70+(this.blocks.length%12)*68,w:300,h:70,font:'Instrument Sans',size:14,color:'#101729',background:'#ffffff',backgroundEnabled:false,borderColor:'#cbd5e1',border:0,bold:false,italic:false,align:'left',content:content[type] || '',label:{label:'Name',notes:'Notes',terms:'Terms',address:'Address'}[type] || '',src:'',tax:0,discount:0,shipping:0,paid:0,items:[]};
            if (['company','title','heading'].includes(type)) { b.size = type === 'title' ? 32 : 24; b.bold = true; }
            if (['logo','qr'].includes(type)) { b.w = 150; b.h = 150; }
            if (['notes','terms','address','empty','text'].includes(type)) b.h = 130;
            if (type === 'date') { b.label = 'Date'; b.dateFormat = 'DD/MM/YYYY'; b.h = 42; }
            if (['field','label'].includes(type)) {
                b.lineWidth = type === 'field' ? 290 : 190;
                b.lineThickness = 1; b.lineStyle = 'solid'; b.lineColor = '#101729';
                b.labelWidth = 70; b.fieldGap = 8; b.delimiter = ':'; b.h = 42;
            }
            if (type === 'table') {
                b.headerBackground = '#141b27'; b.headerColor = '#ffffff';
                b.columns = {item:'Item', quantity:'Quantity', rate:'Rate', amount:'Amount'};
            }
            if (type === 'empty') b.border = 1;
            if (type === 'separator') { b.w = 780; b.h = 36; b.border = 1; }
            if (type === 'table') { b.x = x ?? 60; b.w = 780; b.h = 180; b.items = [{id:this.id(),description:'',qty:1,rate:0}]; }
            if (type === 'summary') {
                b.x = x ?? 510; b.y = y ?? 880; b.h = 310;
                b.visible = Object.fromEntries(this.summaryRows.map(row => [row.key, ['subtotal','total'].includes(row.key)]));
                b.labels = Object.fromEntries(this.summaryRows.map(row => [row.key, row.label]));
            }
            b.placeholder = {notes:'(optional) Notes - any relevant information not already covered',terms:'(optional) Terms and conditions - late fees, payment methods, delivery schedule',address:'Street Address, City'}[type] || '';
            this.constrain(b); this.blocks.push(b); this.selectedId = b.id;
        },
        blockStyle(b) { return {left:b.x+'px',top:b.y+'px',width:b.w+'px',height:b.h+'px',fontFamily:b.font,fontSize:b.size+'px',fontWeight:b.bold?'700':'400',fontStyle:b.italic?'italic':'normal',color:b.color,textAlign:b.align,background:b.type !== 'logo' && b.backgroundEnabled ? b.background : 'transparent'}; },
        paletteDrag(e,type) { e.dataTransfer.setData('application/x-invoice-box',type); e.dataTransfer.effectAllowed='copy'; },
        dropBox(e) { const r=this.$refs.sheet.getBoundingClientRect(); this.addBlock(e.dataTransfer.getData('application/x-invoice-box'),e.clientX-r.left,e.clientY-r.top); },
        startGesture(e,b,resize) {
            if (e.button !== 0) return;
            this.selectedId=b.id;
            const start={x:e.clientX,y:e.clientY,bx:b.x,by:b.y,w:b.w,h:b.h};
            const handle=e.currentTarget; handle.setPointerCapture(e.pointerId);
            const move=event=>{ if(resize){ b.w=start.w+event.clientX-start.x; b.h=start.h+event.clientY-start.y; }else{b.x=start.bx+event.clientX-start.x;b.y=start.by+event.clientY-start.y;} this.constrain(b, resize && Math.abs(event.clientY-start.y) > Math.abs(event.clientX-start.x) ? 'height' : 'width'); };
            const end=()=>{handle.removeEventListener('pointermove',move);handle.removeEventListener('pointerup',end);handle.removeEventListener('pointercancel',end);handle.removeEventListener('lostpointercapture',end);this.saveToStorage();};
            handle.addEventListener('pointermove',move);handle.addEventListener('pointerup',end);handle.addEventListener('pointercancel',end);handle.addEventListener('lostpointercapture',end);
        },
        nudge(b,x,y) {b.x+=x;b.y+=y;this.constrain(b);},
        removeBlock(id) {this.blocks=this.blocks.filter(b=>b.id!==id);if(this.selectedId===id)this.selectedId=null;},
        moveLayer(index,direction) {const target=index+direction;if(target<0||target>=this.blocks.length)return;const [b]=this.blocks.splice(index,1);this.blocks.splice(target,0,b);},
        duplicateBlock(b) {const copy=JSON.parse(JSON.stringify(b));copy.id=this.id();copy.x+=20;copy.y+=20;this.constrain(copy);this.blocks.push(copy);this.selectedId=copy.id;},
        addItem(b) {b.items.push({id:this.id(),description:'',qty:1,rate:0});b.h=Math.max(b.h,95+b.items.length*45);this.constrain(b);},
        uploadLogo(e,b) {
            const file = e.target.files[0];
            if (!file) return;
            if (!['image/png','image/jpeg','image/webp'].includes(file.type) || file.size > 5*1024*1024) {
                this.error = 'Choose a PNG, JPEG or WebP image under 5 MB.';
                return;
            }
            const reader = new FileReader();
            const failed = () => { this.error = 'The image could not be read. Please try again.'; };
            reader.onload = () => {
                const image = new Image();
                image.onload = () => {
                    if (!image.naturalWidth || !image.naturalHeight) { failed(); return; }
                    const scale = Math.min(1, 240 / image.naturalWidth, 180 / image.naturalHeight);
                    b.aspectRatio = image.naturalWidth / image.naturalHeight;
                    b.w = image.naturalWidth * scale;
                    b.h = image.naturalHeight * scale;
                    this.constrain(b);
                    b.src = reader.result;
                    this.error = '';
                };
                image.onerror = failed;
                image.src = reader.result;
            };
            reader.onerror = failed;
            reader.readAsDataURL(file);
            e.target.value = '';
        },
        makeQr(b) {this.error='';if(!b.content.trim()){b.src='';this.error='Enter text or a URL for your QR code.';return;}try{if(typeof QRCode==='undefined')throw new Error();const container=document.createElement('div');new QRCode(container,{text:b.content,width:256,height:256,colorDark:'#000000',colorLight:'#ffffff',correctLevel:QRCode.CorrectLevel.M});const canvas=container.querySelector('canvas');if(!canvas)throw new Error();b.src=canvas.toDataURL('image/png');}catch{this.error='QR code could not be generated. Try shorter text or reload the page.';}},
        get subtotal() {return this.blocks.filter(b=>b.type==='table').reduce((sum,b)=>sum+b.items.reduce((n,i)=>n+this.positive(i.qty)*this.positive(i.rate),0),0);},
        total(b) {
            const tax = b.visible.tax ? this.subtotal * this.positive(b.tax) / 100 : 0;
            const discount = b.visible.discount ? this.positive(b.discount) : 0;
            const shipping = b.visible.shipping ? this.positive(b.shipping) : 0;
            return Math.max(0, this.subtotal + tax - discount + shipping);
        },
        balance(b) {return Math.max(0, this.total(b) - (b.visible.paid ? this.positive(b.paid) : 0));},
        formatNum(n) {return (Number(n)||0).toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});},
        money(n) {return this.currency+this.formatNum(n);},
        async invoiceCanvas() {
            await document.fonts.ready;
            await this.$nextTick();
            await Promise.all(Array.from(this.$refs.sheet.querySelectorAll('img')).filter(img => img.getAttribute('src')).map(img => img.decode()));
            document.body.classList.add('is-exporting');
            try {
                await this.$nextTick();
                return await html2canvas(this.$refs.sheet, {scale:2,useCORS:true,backgroundColor:'#ffffff',logging:false});
            } finally { document.body.classList.remove('is-exporting'); }
        },
        async printInvoice() {
            if (this.isPrinting || this.isGenerating) return;
            this.isPrinting = true; this.error = '';
            let frame;
            try {
                const canvas = await this.invoiceCanvas();
                document.getElementById('builder-print-frame')?.remove();
                frame = document.createElement('iframe');
                frame.id = 'builder-print-frame';
                frame.title = 'Print invoice';
                frame.setAttribute('aria-hidden', 'true');
                frame.style.cssText = 'position:fixed;left:-10000px;top:0;width:794px;height:1123px;border:0;';
                await new Promise((resolve, reject) => {
                    const timeout = setTimeout(() => reject(new Error('Print preview timed out')), 15000);
                    frame.onload = () => { clearTimeout(timeout); resolve(); };
                    frame.onerror = () => { clearTimeout(timeout); reject(new Error('Print preview failed')); };
                    frame.srcdoc = '<!doctype html><html><head><title>Invoice</title><style>@page{size:A4 portrait;margin:0}html,body{margin:0;padding:0}img{display:block;width:210mm;height:297mm;print-color-adjust:exact;-webkit-print-color-adjust:exact}</style></head><body></body></html>';
                    document.body.appendChild(frame);
                });
                const picture = frame.contentDocument.createElement('img');
                picture.alt = 'Invoice';
                picture.src = canvas.toDataURL('image/png');
                frame.contentDocument.body.appendChild(picture);
                await picture.decode();
                await new Promise(resolve => frame.contentWindow.requestAnimationFrame(() => frame.contentWindow.requestAnimationFrame(resolve)));
                frame.contentWindow.focus();
                frame.contentWindow.print();
            } catch (error) {
                frame?.remove();
                this.error = 'Print could not be prepared. Please try again.';
                console.error(error);
            } finally { this.isPrinting = false; }
        },
        async downloadInvoice() {
            if(this.isGenerating || this.isPrinting)return;
            this.isGenerating=true;this.error='';
            try {
                const canvas = await this.invoiceCanvas();
                if(this.downloadFormat==='pdf') {const pdf=new window.jspdf.jsPDF({unit:'mm',format:'a4'});pdf.addImage(canvas.toDataURL('image/png'),'PNG',0,0,210,297);pdf.save('custom-invoice.pdf');}
                else {const link=document.createElement('a');link.download='custom-invoice.png';link.href=canvas.toDataURL('image/png');link.click();}
            } catch(error) {this.error='Download failed. Please reload and try again.';console.error(error);}
            finally {document.body.classList.remove('is-exporting');this.isGenerating=false;}
        }
    };
}