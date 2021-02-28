let demo, mainAnim;

function Animat(elem){
    this.elem = elem;
    this['stroke-width'] = 10;
    this.render = function() {
        this.calcBorderProps();
        this.elem.setAttribute('height', this.height);
        this.elem.setAttribute('width', this.width);
        this.path.setAttribute('d', this.d);
    }
    this.calcBorderProps = function() {
        this.parent = this.elem.parentElement;
        this.path = this.elem.getElementsByTagName('path')[0];
        this.height = this.parent.offsetHeight;
        this.width = this.parent.offsetWidth;
        let offset = this['stroke-width'] / 2;
        this.d = `M ${offset} ${10 + offset} A 10 10 0 0 1 ${10 + offset} ${offset} H ${this.width-10-offset} A 10 10 0 0 1 ${this.width-offset} ${10 + offset} V ${this.height-10-offset} A 10 10 0 0 1 ${this.width-10-offset} ${this.height-offset} H ${10 + offset} A 10 10 0 0 1 ${offset} ${this.height-10-offset} Z`;
    }
    this.calcAnimProps = function() {
        this.paths = this.elem.querySelectorAll('path,rect,circle,ellipse,line,polygon,polyline,text');       
        this.parent = this.elem.parentElement;
        this.height = this.parent.offsetHeight;
        this.elem.setAttribute('height', this.height-10)
    }
    this.setStrokeWidth = function(width) {
        this.strokeWidth = width;
    }
    this.setSpeed = function(s) {
        this.dur = s;
    }
    this.setAnimation = function() {
        for (path of this.paths) {
            let len = path.getTotalLength();
            path.setAttribute('stroke-dasharray', len);
            path.setAttribute('stroke-width', this.strokeWidth);
            path.setAttribute('stroke-linecap', 'round ');
            path.setAttribute('stroke', 'black');
            path.setAttribute('vector-effect', 'non-scaling-stroke');
            path.setAttribute('fill-opacity', '0');
            let anim1 = document.createElementNS('http://www.w3.org/2000/svg', 'animate');
            anim1.setAttribute('attributeName', 'stroke-dashoffset');
            anim1.setAttribute('from', len);
            anim1.setAttribute('to', -len);
            anim1.setAttribute('dur', this.dur+'s');
            anim1.setAttribute('begin', '0s');
            anim1.setAttribute('repeatCount', 'indefinite');
            path.appendChild(anim1);
            let anim2 = document.createElementNS('http://www.w3.org/2000/svg', 'animate');
            anim2.setAttribute('attributeName', 'fill-opacity');
            anim2.setAttribute('from', 0);
            anim2.setAttribute('to', 1);
            anim2.setAttribute('dur', this.dur+'s');
            anim2.setAttribute('begin', `0s`);
            anim2.setAttribute('values', '0; 1; 0');
            anim2.setAttribute('keytimes', '0; 0.5; 1');
            anim2.setAttribute('repeatCount', 'indefinite');
            path.appendChild(anim2);
        }
        this.paths[0].firstChild.setAttribute('id', 'animFirst');
    }
}

window.onload = () => {
    demo = new Animat(document.getElementsByClassName('demo')[0]);
    demo.render();
    mainAnim = new Animat(document.getElementsByClassName('anim')[0].getElementsByTagName('svg')[0]);
    mainAnim.setStrokeWidth(5);
    mainAnim.setSpeed(5)
    mainAnim.calcAnimProps();
    mainAnim.setAnimation();
    window.onresize = handleResize;
    document.getElementById('strokeWidth').addEventListener('change', handleWidth.bind(this));
    document.getElementById('speed').addEventListener('change', handleSpeed.bind(this));
}

function handleResize() {
    demo.render();
}

function handleWidth(event) {
    mainAnim.setStrokeWidth(event.target.value);
    mainAnim.setAnimation();
}

function handleSpeed(event) {
    mainAnim.setSpeed(event.target.value);
    mainAnim.setAnimation();
}