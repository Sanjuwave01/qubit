class World {
  renderer;
  scene;
  camera;
  molecule;

  constructor() {
    this.build();
    
    window.addEventListener('resize', this.resize.bind(this))

    this.animate = this.animate.bind(this);
    this.animate();
  }

  build() {
    this.scene = new THREE.Scene();
    this.camera = new THREE.PerspectiveCamera(
      75,
      window.innerWidth / window.innerHeight,
      0.1,
      1000
    );
    this.camera.position.z = 3;

    this.renderer = new THREE.WebGLRenderer({
      alpha:true,
      antialias:true
    });
    this.renderer.setPixelRatio( window.devicePixelRatio );
    this.renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.appendChild(this.renderer.domElement);
    
    this.molecule = new Molecule()
    this.scene.add(this.molecule);
  }

  resize() {
    const w = window.innerWidth;
    const h = window.innerHeight;
    this.camera.aspect = w / h;
    this.camera.updateProjectionMatrix();
    this.renderer.setSize(w, h);
  }

  animate() {
    requestAnimationFrame(this.animate);
    
    const time = performance.now() * 0.001;

    this.molecule.animate(time);
    

    this.renderer.render(this.scene, this.camera);
  }
}

class Molecule extends THREE.Object3D{
  material;
  geometry;
  mesh;
  radius = 1.5;
  detail = 40;
  particleSizeMin = 0.01;
  particleSizeMax = 0.08;

  constructor() {
    super();
    
    this.build();
  }

  build() {
    
    this.dot()
    
    this.geometry = new THREE.IcosahedronBufferGeometry(1, this.detail);

    this.material = new THREE.PointsMaterial( {
      map:this.dot(),
      blending: THREE.AdditiveBlending,
      color:0x101A88,
      depthTest:false
    } )

    this.setupShader(this.material)

    this.mesh = new THREE.Points(this.geometry, this.material);
    this.add(this.mesh);
  }
  
  dot(size = 32, color = "#FFFFFF"){
    const sizeH = size * 0.5;
    
    const canvas = document.createElement('canvas')
    canvas.width = canvas.height = size
    
    const ctx = canvas.getContext('2d')
    
    const circle = new Path2D()
    circle.arc(sizeH, sizeH, sizeH, 0, 2 * Math.PI);
    
    ctx.fillStyle = color;
    ctx.fill(circle);
    
    // debug canvas
    // canvas.style.position = "fixed"
    // canvas.style.top = 0
    // canvas.style.left = 0
    // document.body.appendChild(canvas)
    
    return new THREE.CanvasTexture(canvas)
  }

  setupShader(material){
    material.onBeforeCompile = ( shader ) => {
      shader.uniforms.time = { value: 0 }
      shader.uniforms.radius = { value: this.radius }
      shader.uniforms.particleSizeMin = { value: this.particleSizeMin }
      shader.uniforms.particleSizeMax = { value: this.particleSizeMax }
      shader.vertexShader = 'uniform float particleSizeMax;\n' + shader.vertexShader;
      shader.vertexShader = 'uniform float particleSizeMin;\n' + shader.vertexShader;
      shader.vertexShader = 'uniform float radius;\n' + shader.vertexShader;
      shader.vertexShader = 'uniform float time;\n' + shader.vertexShader;
      shader.vertexShader = document.getElementById("webgl-noise").textContent + "\n" + shader.vertexShader;
      shader.vertexShader = shader.vertexShader.replace(
        '#include <begin_vertex>',
        `
          vec3 p = position;
          float n = snoise( vec3( p.x*.6 + time*0.2, p.y*0.4 + time*0.3, p.z*.2 + time*0.2) );
          p += n *0.4;

          // constrain to sphere radius
          float l = radius / length(p);
          p *= l;
          float s = mix(particleSizeMin, particleSizeMax, n);
          vec3 transformed = vec3( p.x, p.y, p.z );
        `
      )
      shader.vertexShader = shader.vertexShader.replace(
        'gl_PointSize = size;',
        'gl_PointSize = s;'
      )

      material.userData.shader = shader;

    }
  }

  animate(time) {
    this.mesh.rotation.set(0, time * 0.2, 0);
    if(this.material.userData.shader)
      this.material.userData.shader.uniforms.time.value = time;
  }

}

new World();



//References to DOM elements
var $window = $(window);
var $document = $(document);
//Only links that starts with #
var $navButtons = $("nav a").filter("[href^=#]");
var $navGoPrev = $(".go-prev");
var $navGoNext = $(".go-next");
var $slidesContainer = $(".slides-container");
var $slides = $(".slide");
var $currentSlide = $slides.first();

//Animating flag - is our app animating
var isAnimating = false;

//The height of the window
var pageHeight = $window.innerHeight();

//Key codes for up and down arrows on keyboard. We'll be using this to navigate change slides using the keyboard
var keyCodes = {
    UP  : 38,
    DOWN: 40
}

//Going to the first slide
goToSlide($currentSlide);


/*
*   Adding event listeners
* */

$window.on("resize", onResize).resize();
$window.on("mousewheel DOMMouseScroll", onMouseWheel);
$document.on("keydown", onKeyDown);
$navButtons.on("click", onNavButtonClick);
$navGoPrev.on("click", goToPrevSlide);
$navGoNext.on("click", goToNextSlide);

/*
*   Internal functions
* */


/*
*   When a button is clicked - first get the button href, and then slide to the container, if there's such a container
* */
function onNavButtonClick(event) {
    //The clicked button
    var $button = $(this);

    //The slide the button points to
    var $slide = $($button.attr("href"));

    //If the slide exists, we go to it
    if($slide.length)
    {
        goToSlide($slide);
        event.preventDefault();
    }
}

/*
*   Getting the pressed key. Only if it's up or down arrow, we go to prev or next slide and prevent default behaviour
*   This way, if there's text input, the user is still able to fill it
* */
function onKeyDown(event) {

    var PRESSED_KEY = event.keyCode;

    if(PRESSED_KEY == keyCodes.UP)
    {
        goToPrevSlide();
        event.preventDefault();
    }
    else if(PRESSED_KEY == keyCodes.DOWN)
    {
        goToNextSlide();
        event.preventDefault();
    }

}

/*
*   When user scrolls with the mouse, we have to change slides
* */
function onMouseWheel(event)
{
    //Normalize event wheel delta
    var delta = event.originalEvent.wheelDelta / 30 || -event.originalEvent.detail;

    //If the user scrolled up, it goes to previous slide, otherwise - to next slide
    if(delta < -1)
    {
        goToNextSlide();
    }
    else if(delta > 1)
    {
        goToPrevSlide();
    }

    event.preventDefault();
}

/*
*   If there's a previous slide, slide to it
* */
function goToPrevSlide() {
    if($currentSlide.prev().length)    {
        goToSlide($currentSlide.prev());
    }
}

/*
*   If there's a next slide, slide to it
* */
function goToNextSlide() {
    if($currentSlide.next().length)    {
        goToSlide($currentSlide.next());
    }
}

/*
*   Actual transition between slides
* */
function goToSlide($slide) {
    //If the slides are not changing and there's such a slide
    if(!isAnimating && $slide.length)     {
        //setting animating flag to true
        isAnimating = true;
        $currentSlide = $slide;
        
        var currentslide = $currentSlide.attr('id');
        $('body').removeClass();
        $('body').addClass(currentslide);
        $('.slide').removeClass('currentView');
        $currentSlide.addClass('currentView');
        
        //Sliding to current slide
        TweenLite.to($slidesContainer, 1, {scrollTo: {y: pageHeight * $currentSlide.index() }, onComplete: onSlideChangeEnd, onCompleteScope: this});

        //Animating menu items
        TweenLite.to($navButtons.filter(".active"), 0.5, {className: "-=active"});

        TweenLite.to($navButtons.filter("[href=#" + $currentSlide.attr("id") + "]"), 0.5, {className: "+=active"});

    }
}

/*
*   Once the sliding is finished, we need to restore "isAnimating" flag.
*   You can also do other things in this function, such as changing page title
* */
function onSlideChangeEnd() {
    isAnimating = false;
}

/*
*   When user resize it's browser we need to know the new height, so we can properly align the current slide
* */
function onResize(event) {

    //This will give us the new height of the window
    var newPageHeight = $window.innerHeight();

    /*
    *   If the new height is different from the old height ( the browser is resized vertically ), the slides are resized
    * */
    if(pageHeight !== newPageHeight)
    {
        pageHeight = newPageHeight;

        //This can be done via CSS only, but fails into some old browsers, so I prefer to set height via JS
        TweenLite.set([$slidesContainer, $slides], {height: pageHeight + "px"});

        //The current slide should be always on the top
        TweenLite.set($slidesContainer, {scrollTo: {y: pageHeight * $currentSlide.index() }});
    }

}


