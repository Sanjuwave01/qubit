<?php require_once 'header.php';?>
<div class="slides-container">
        
        <div class="slide" id="slide-1">    
          <script id="webgl-noise" type="x-shader/x-vertex">
            //
            // Description : Array and textureless GLSL 2D/3D/4D simplex
            //               noise functions.
            //      Author : Ian McEwan, Ashima Arts.
            //  Maintainer : stegu
            //     Lastmod : 20201014 (stegu)
            //     License : Copyright (C) 2011 Ashima Arts. All rights reserved.
            //               Distributed under the MIT License. See LICENSE file.
            //               https://github.com/ashima/webgl-noise
            //               https://github.com/stegu/webgl-noise
            //
            
            vec3 mod289(vec3 x) {
              return x - floor(x * (1.0 / 289.0)) * 289.0;
            }
            
            vec4 mod289(vec4 x) {
              return x - floor(x * (1.0 / 289.0)) * 289.0;
            }
            
            vec4 permute(vec4 x) {
              return mod289(((x*34.0)+10.0)*x);
            }
            
            vec4 taylorInvSqrt(vec4 r)
            {
              return 1.79284291400159 - 0.85373472095314 * r;
            }
            
            float snoise(vec3 v)
            {
              const vec2  C = vec2(1.0/6.0, 1.0/3.0) ;
              const vec4  D = vec4(0.0, 0.5, 1.0, 2.0);
            
              // First corner
              vec3 i  = floor(v + dot(v, C.yyy) );
              vec3 x0 =   v - i + dot(i, C.xxx) ;
            
              // Other corners
              vec3 g = step(x0.yzx, x0.xyz);
              vec3 l = 1.0 - g;
              vec3 i1 = min( g.xyz, l.zxy );
              vec3 i2 = max( g.xyz, l.zxy );
            
              //   x0 = x0 - 0.0 + 0.0 * C.xxx;
              //   x1 = x0 - i1  + 1.0 * C.xxx;
              //   x2 = x0 - i2  + 2.0 * C.xxx;
              //   x3 = x0 - 1.0 + 3.0 * C.xxx;
              vec3 x1 = x0 - i1 + C.xxx;
              vec3 x2 = x0 - i2 + C.yyy; // 2.0*C.x = 1/3 = C.y
              vec3 x3 = x0 - D.yyy;      // -1.0+3.0*C.x = -0.5 = -D.y
            
              // Permutations
              i = mod289(i);
              vec4 p = permute( permute( permute(
                          i.z + vec4(0.0, i1.z, i2.z, 1.0 ))
                        + i.y + vec4(0.0, i1.y, i2.y, 1.0 ))
                        + i.x + vec4(0.0, i1.x, i2.x, 1.0 ));
            
              // Gradients: 7x7 points over a square, mapped onto an octahedron.
              // The ring size 17*17 = 289 is close to a multiple of 49 (49*6 = 294)
              float n_ = 0.142857142857; // 1.0/7.0
              vec3  ns = n_ * D.wyz - D.xzx;
            
              vec4 j = p - 49.0 * floor(p * ns.z * ns.z);  //  mod(p,7*7)
            
              vec4 x_ = floor(j * ns.z);
              vec4 y_ = floor(j - 7.0 * x_ );    // mod(j,N)
            
              vec4 x = x_ *ns.x + ns.yyyy;
              vec4 y = y_ *ns.x + ns.yyyy;
              vec4 h = 1.0 - abs(x) - abs(y);
            
              vec4 b0 = vec4( x.xy, y.xy );
              vec4 b1 = vec4( x.zw, y.zw );
            
              //vec4 s0 = vec4(lessThan(b0,0.0))*2.0 - 1.0;
              //vec4 s1 = vec4(lessThan(b1,0.0))*2.0 - 1.0;
              vec4 s0 = floor(b0)*2.0 + 1.0;
              vec4 s1 = floor(b1)*2.0 + 1.0;
              vec4 sh = -step(h, vec4(0.0));
            
              vec4 a0 = b0.xzyw + s0.xzyw*sh.xxyy ;
              vec4 a1 = b1.xzyw + s1.xzyw*sh.zzww ;
            
              vec3 p0 = vec3(a0.xy,h.x);
              vec3 p1 = vec3(a0.zw,h.y);
              vec3 p2 = vec3(a1.xy,h.z);
              vec3 p3 = vec3(a1.zw,h.w);
            
              //Normalise gradients
              vec4 norm = taylorInvSqrt(vec4(dot(p0,p0), dot(p1,p1), dot(p2, p2), dot(p3,p3)));
              p0 *= norm.x;
              p1 *= norm.y;
              p2 *= norm.z;
              p3 *= norm.w;
            
              // Mix final noise value
              vec4 m = max(0.5 - vec4(dot(x0,x0), dot(x1,x1), dot(x2,x2), dot(x3,x3)), 0.0);
              m = m * m;
              return 105.0 * dot( m*m, vec4( dot(p0,x0), dot(p1,x1),
                                            dot(p2,x2), dot(p3,x3) ) );
            }
            
          </script>
          <div class="container data">
              <h1 class="title">FIRST GLOBAL WEB 3.0 WELLNESS COMMUNITY WITH AI AND BLOCKCHAIN</h1>
              <span class="droplet hero__droplet hero__droplet_small"></span>
              <span class="droplet hero__droplet hero__droplet_big"></span>
              <div class="droplet hero__picture-droplet hero__picture-droplet_small"></div>
              <div class="droplet hero__picture-droplet hero__picture-droplet_medium"></div>
              <div class="droplet hero__picture-droplet hero__picture-droplet_large"></div>
              <div class="d-flex align-items-center mt-3 fadeInDown">
                <span class="go-next">Buy Token</span>
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 67 67" style="enable-background:new 0 0 67 67;" xml:space="preserve">
                  <g>
                      <g>
                          <path d="M65.25,33c0-1.104-0.896-2-2-2H24.838l8.511-8.32c0.781-0.781,0.781-1.952,0-2.733c-0.78-0.781-2.047-0.734-2.828,0.047
                              L17.707,32.832c-0.375,0.375-0.586,0.896-0.586,1.426s0.211,1.045,0.586,1.42l12.815,12.815c0.391,0.391,0.902,0.587,1.414,0.587
                              c0.512,0,1.024-0.194,1.415-0.585c0.781-0.781,0.781-2.237,0-3.018L23.062,35H63.25C64.354,35,65.25,34.104,65.25,33z"/>
                          <path fill-opacity="0.5" d="M45.75,59.281v-11.9c0-1.104-0.896-2-2-2c-1.104,0-2,0.896-2,2v11.9c0,2.691-2.036,3.719-4.541,3.719H11.208
                              C8.82,63,5.75,62.098,5.75,59.281V9.541C5.75,6.841,8.613,4,11.208,4h26.001c2.592,0,4.541,2.889,4.541,5.541v11.84
                              c0,1.104,0.896,2,2,2c1.104,0,2-0.896,2-2V9.541C45.75,4.661,42.025,0,37.209,0H11.208C6.436,0,1.75,4.661,1.75,9.541v49.74
                              C1.75,63.898,6.101,67,11.208,67h26.001C42.363,67,45.75,63.898,45.75,59.281z"/>
                      </g>
                  </g>
                </svg>
              </div>
              <div class="coinview">
                <figure>
                  <a href="https://www.coingecko.com/en/coins/jasan-wellness"><img src="<?php echo base_url() ?>assets/images/coin-gecko.png" alt="" /></a>
                </figure>
                <figure>
                  <a href="https://www.livecoinwatch.com/price/JasanWellness-JW"><img src="<?php echo base_url() ?>assets/images/id07CMwSyn.png" alt="" /></a>
                </figure>
              </div>
			  <img src="<?php echo base_url() ?>assets/images/home.png" alt="" class="main_banner" />
          </div>
          
          
        </div>


        <div class="slide" id="slide-2">
            <div class="container data">
              <div class="row justify-content-around align-items-end">
                <div class="col-lg-4 col-12 pb-5">
                  <p>AI Personal wellness App</p>
                  <h3 class="title colored-text">Fastest Growing </h3>
                  <div class="subparagraph">
                      <h5 class="subtitle">Wellness Token App</h5>
                      <p>There have been tools which can lead them to a healthy state and maintain the state. Our challenge is to find out how to utilize these tools to obtain better results for becoming healthy. </p>
                  </div>
                </div>
                <div class="col-lg-8 col-12 ">
                  <svg class="concept-schema__element" width="1154" height="1100" viewBox="0 0 1154 905" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <style type="text/css">
	.st0{fill:none;stroke:#3E4A5B;stroke-width:5;}
	.st1{fill:url(#wire_00000061458658163308020050000012514607195493702552_);}
	.st2{fill:url(#wire_00000178200327049666526290000014615460165095003578_);}
	.st3{fill:url(#SVGID_1_);}
	.st4{fill:#313741;}
	.st5{fill:#32353E;}
	.st6{fill:#21242B;}
	.st7{fill:url(#SVGID_00000128455682246191065840000002629226945759371934_);fill-opacity:0.8;}
	.st8{fill:url(#SVGID_00000018927299935612700560000003341203260827028154_);fill-opacity:0.8;}
	.st9{fill:#FFFFFF;}
	.st10{fill:url(#SVGID_00000061463902895209766240000004161655388203844248_);fill-opacity:0.5;}
	.st11{fill:url(#SVGID_00000133523395126010780930000016921768862742219410_);fill-opacity:0.6;}
	.st12{fill:url(#SVGID_00000081620762437039069850000001131654501754915514_);fill-opacity:0.9;}
	.st13{fill:url(#circle-white-shadow_00000087375182293359533520000001642156067426281637_);fill-opacity:0.2;}
	.st14{fill:url(#SVGID_00000000930053602688566240000005427700816561174440_);fill-opacity:0.8;}
	.st15{fill:url(#SVGID_00000135667134337441938700000018429855202747661975_);}
	.st16{fill:#2C313A;}
	.st17{fill:url(#SVGID_00000178887067964760222010000001818052448799136142_);}
	.st18{fill:#292D34;}
	.st19{fill:url(#SVGID_00000096038682590831560130000001883373424955014578_);fill-opacity:0.8;}
	.st20{fill:url(#SVGID_00000157293705290976433400000002673608694003962275_);}
	.st21{fill:url(#SVGID_00000037673338707496314850000004160398752543350928_);}
	.st22{fill:#2A2F36;}
	.st23{fill:url(#SVGID_00000096037048774427910440000005371780238301564069_);}
	.st24{fill:#86BAF3;}
	.st25{fill:url(#SVGID_00000094613009209791881570000006067135798733991341_);}
	.st26{opacity:0;}
	.st27{fill:#88D7F1;}
	.st28{fill:url(#SVGID_00000074405250097811393390000014723806360634788540_);}
	.st29{fill:url(#SVGID_00000171693751467533877500000010570848110911860623_);}
	.st30{fill:none;}
	.st31{fill:url(#SVGID_00000135657625663892898410000013437451252584674953_);fill-opacity:0.8;}
	.st32{fill:url(#SVGID_00000091700572598098304160000000108546792396961715_);fill-opacity:0.8;}
	.st33{fill:url(#SVGID_00000024702039544130598290000000675606645954157222_);fill-opacity:0.5;}
	.st34{fill:url(#SVGID_00000179625365131026562440000003389979370593494684_);fill-opacity:0.6;}
	.st35{fill:url(#SVGID_00000152238091844387005210000011229369524684034444_);fill-opacity:0.9;}
	.st36{fill:url(#circle-black-shadow_00000005256559176613824830000009219028141065834130_);fill-opacity:0.4;}
	.st37{fill:url(#circle-black_00000077313521986709134340000000502827720973254533_);}
	.st38{fill:#00B1FF;}
	.st39{filter:url(#Adobe_OpacityMaskFilter);}
	.st40{filter:url(#Adobe_OpacityMaskFilter_00000048461601149831471800000010468901823353558665_);}
	
		.st41{mask:url(#SVGID_00000117678613327961169390000000332848288160020359_);fill:url(#SVGID_00000013900557778885689480000016360435623331701665_);}
	.st42{fill:url(#SVGID_00000179632652151242976130000007682999995009902497_);}
	.st43{fill:none;stroke:#FFFFFF;stroke-width:2;stroke-miterlimit:10;}
	.st44{filter:url(#Adobe_OpacityMaskFilter_00000114767550299832124240000006397503843846118287_);}
	.st45{filter:url(#Adobe_OpacityMaskFilter_00000065791453222423945230000006119828727758106291_);}
	
		.st46{mask:url(#SVGID_00000059273519829946343140000000814249744826821269_);fill:url(#SVGID_00000114782147157384959180000018205847528244118698_);}
	.st47{fill:url(#SVGID_00000052070239075622900220000000937719839819260828_);}
	.st48{filter:url(#Adobe_OpacityMaskFilter_00000083773169973198920470000016846145630527790242_);}
	.st49{filter:url(#Adobe_OpacityMaskFilter_00000000931594505819723120000012840394105048187522_);}
	
		.st50{mask:url(#SVGID_00000001658521830910564020000005347736005145942940_);fill:url(#SVGID_00000113335814857151093180000003897041228297995426_);}
	.st51{fill:url(#SVGID_00000137816106430562299490000007526508867034584985_);}
	.st52{filter:url(#Adobe_OpacityMaskFilter_00000103979940926457516980000004882669670660635532_);}
	.st53{filter:url(#Adobe_OpacityMaskFilter_00000103256208626661169570000006588660805483176065_);}
	
		.st54{mask:url(#SVGID_00000137131152556040169450000011393291405312298936_);fill:url(#SVGID_00000044167444898702050670000006659028168789201589_);}
	.st55{fill:url(#SVGID_00000164482136545787495300000013241178801583647917_);}
	.st56{filter:url(#Adobe_OpacityMaskFilter_00000145737494005936790600000007535996076968588220_);}
	.st57{filter:url(#Adobe_OpacityMaskFilter_00000068656206292538113890000016296643636980694455_);}
	
		.st58{mask:url(#SVGID_00000106131655772615100510000002205179428661229963_);fill:url(#SVGID_00000013889973843857595360000012476334481154373285_);}
	.st59{fill:url(#SVGID_00000033367731185427359760000014705025111652044475_);}
	.st60{opacity:0.2;fill:#FFFFFF;}
	.st61{fill:url(#SVGID_00000062172454282949275110000004473846148875485363_);}
	.st62{opacity:0.1;}
	.st63{fill:url(#SVGID_00000068652011836563371450000015796791126028993453_);}
	.st64{fill:url(#SVGID_00000023277020604381187350000000715515347096065176_);}
	.st65{fill:url(#SVGID_00000171682680216788425590000007097595247356903849_);}
</style>
<g>
	<path class="st0" d="M195.5,461H106V206"/>
	<path class="st0" d="M1065.5,800h69V593"/>
</g>
<g>
	
		<linearGradient id="wire_00000097501179950186109050000004044202719734022576_" gradientUnits="userSpaceOnUse" x1="590.9949" y1="124.851" x2="563.3856" y2="190.1626" gradientTransform="matrix(1 0 0 1 0 451.0001)">
		<stop  offset="9.999999e-02" style="stop-color:#000000"/>
		<stop  offset="0.2" style="stop-color:#000000"/>
		<stop  offset="0.3" style="stop-color:#000000"/>
		<stop  offset="0.4" style="stop-color:#000000"/>
		<stop  offset="0.5" style="stop-color:#000000"/>
		<stop  offset="0.6" style="stop-color:#000000"/>
		<stop  offset="0.7" style="stop-color:#000000"/>
		<stop  offset="0.8" style="stop-color:#000000"/>
		<stop  offset="0.9" style="stop-color:#000000"/>
		<stop  offset="1" style="stop-color:#000000"/>
	</linearGradient>
	
		<path id="wire_00000054986737981492223370000008447105716640581769_" style="fill:url(#wire_00000097501179950186109050000004044202719734022576_);" d="
		M343.5,476.5l281.5,155l188,104l-3,2l-185-102l-151.4-83.6l-130.1-71.6V476.5z"/>
	
		<linearGradient id="wire_00000134931480696936480460000002199003859787497344_" gradientUnits="userSpaceOnUse" x1="487.3214" y1="86.3395" x2="471.6406" y2="123.4332" gradientTransform="matrix(1 0 0 1 0 451.0001)">
		<stop  offset="9.999999e-02" style="stop-color:#000000"/>
		<stop  offset="0.2" style="stop-color:#000000"/>
		<stop  offset="0.3" style="stop-color:#000000"/>
		<stop  offset="0.4" style="stop-color:#000000"/>
		<stop  offset="0.5" style="stop-color:#000000"/>
		<stop  offset="0.6" style="stop-color:#000000"/>
		<stop  offset="0.7" style="stop-color:#000000"/>
		<stop  offset="0.8" style="stop-color:#000000"/>
		<stop  offset="0.9" style="stop-color:#000000"/>
		<stop  offset="1" style="stop-color:#000000"/>
	</linearGradient>
	
		<path id="wire_00000167391522215708273210000016919668742532592812_" style="fill:url(#wire_00000134931480696936480460000002199003859787497344_);" d="
		M622,633.5L337.5,477"/>
</g>
<linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="347.75" y1="6.7999" x2="347.75" y2="140.2999" gradientTransform="matrix(1 0 0 1 0 451.0001)">
	<stop  offset="0" style="stop-color:#1B1D22"/>
	<stop  offset="0.5104" style="stop-color:#252932"/>
	<stop  offset="1" style="stop-color:#1B1D22"/>
</linearGradient>
<path class="st3" d="M161.5,478.4v-18.6l185,103.3L534,457.8v18.6c0,3.6-1.9,6.9-5,8.6l-155.4,90.5c-16.8,9.8-37.5,9.8-54.2,0.1
	L166.5,487C163.4,485.2,161.5,481.9,161.5,478.4z"/>
<path class="st4" d="M318.5,357.8c16.8-10.1,37.8-10.3,54.8-0.5l154.2,88.9c8.7,5,8.7,17.5,0,22.5l-154.7,89.5
	c-16.7,9.7-37.4,9.7-54.1,0L168,470.9c-8.6-5-8.7-17.3-0.2-22.4L318.5,357.8z"/>
<g>
	<path class="st5" d="M161.5,491.2v-18.6l185,103.3L534,470.6v18.6c0,3.6-1.9,6.9-5,8.6l-155.4,90.5c-16.8,9.8-37.5,9.8-54.2,0.1
		l-152.9-88.6C163.4,498.1,161.5,494.8,161.5,491.2z"/>
</g>
<g id="small-block-2">
	<path class="st6" d="M204.5,458.8v-10.3L346.8,528L491,447v10.3c0,2.7-1.5,5.3-3.8,6.6l-119.6,69.6c-12.9,7.5-28.8,7.5-41.7,0
		l-117.5-68C206,464.1,204.5,461.6,204.5,458.8z"/>
	
		<linearGradient id="SVGID_00000164482288210240829830000000383255515712590720_" gradientUnits="userSpaceOnUse" x1="338.365" y1="128.1826" x2="353.407" y2="-74.0015" gradientTransform="matrix(1 0 0 1 0 451.0001)">
		<stop  offset="0" style="stop-color:#FF76EA"/>
		<stop  offset="1" style="stop-color:#2AF6FF"/>
	</linearGradient>
	<path style="fill:url(#SVGID_00000164482288210240829830000000383255515712590720_);fill-opacity:0.8;" d="M204.5,458.8v-10.3
		L346.8,528L491,447v10.3c0,2.7-1.5,5.3-3.8,6.6l-119.6,69.6c-12.9,7.5-28.8,7.5-41.7,0l-117.5-68
		C206,464.1,204.5,461.6,204.5,458.8z"/>
	<g>
		
			<linearGradient id="SVGID_00000016764391906061298840000004120890024197749153_" gradientUnits="userSpaceOnUse" x1="338.365" y1="139.1826" x2="353.407" y2="-63.0015" gradientTransform="matrix(1 0 0 1 0 451.0001)">
			<stop  offset="0" style="stop-color:#FF76EA"/>
			<stop  offset="1" style="stop-color:#2AF6FF"/>
		</linearGradient>
		<path style="fill:url(#SVGID_00000016764391906061298840000004120890024197749153_);fill-opacity:0.8;" d="M204.5,469.8v-10.3
			L346.8,539L491,458v10.3c0,2.7-1.5,5.3-3.8,6.6l-119.6,69.6c-12.9,7.5-28.8,7.5-41.7,0l-117.5-68
			C206,475.1,204.5,472.6,204.5,469.8z"/>
	</g>
	<path class="st9" d="M325.3,370.1c12.9-7.8,29.1-7.9,42.2-0.4L486.1,438c6.7,3.8,6.7,13.5,0,17.3l-119,68.9
		c-12.9,7.5-28.8,7.4-41.6,0l-115.9-67.1c-6.6-3.8-6.7-13.3-0.1-17.2L325.3,370.1z"/>
	
		<radialGradient id="SVGID_00000092415111836888659750000017547707611429330077_" cx="559.2045" cy="2.6888" r="1.0007" gradientTransform="matrix(-162.4969 139.0309 -134.7733 -157.5207 91579.2578 -76875.6094)" gradientUnits="userSpaceOnUse">
		<stop  offset="0" style="stop-color:#A0D7F1"/>
		<stop  offset="0.9931" style="stop-color:#DE4FFB"/>
	</radialGradient>
	<path style="fill:url(#SVGID_00000092415111836888659750000017547707611429330077_);fill-opacity:0.5;" d="M325.3,370.1
		c12.9-7.8,29.1-7.9,42.2-0.4L486.1,438c6.7,3.8,6.7,13.5,0,17.3l-119,68.9c-12.9,7.5-28.8,7.4-41.6,0l-115.9-67.1
		c-6.6-3.8-6.7-13.3-0.1-17.2L325.3,370.1z"/>
	
		<radialGradient id="SVGID_00000144322874024612237600000015114257382607467660_" cx="559.5692" cy="2.5716" r="1.0007" gradientTransform="matrix(-174.4969 114.031 -110.5387 -169.1528 98275.2188 -62925.6758)" gradientUnits="userSpaceOnUse">
		<stop  offset="0" style="stop-color:#78C8F8"/>
		<stop  offset="0.68" style="stop-color:#FFFFFF"/>
	</radialGradient>
	<path style="fill:url(#SVGID_00000144322874024612237600000015114257382607467660_);fill-opacity:0.6;" d="M325.3,370.1
		c12.9-7.8,29.1-7.9,42.2-0.4L486.1,438c6.7,3.8,6.7,13.5,0,17.3l-119,68.9c-12.9,7.5-28.8,7.4-41.6,0l-115.9-67.1
		c-6.6-3.8-6.7-13.3-0.1-17.2L325.3,370.1z"/>
	
		<linearGradient id="SVGID_00000014625782862291518850000013807414568797167271_" gradientUnits="userSpaceOnUse" x1="316.0451" y1="174.4285" x2="399.3081" y2="-291.04" gradientTransform="matrix(1 0 0 1 0 451.0001)">
		<stop  offset="0" style="stop-color:#FF76EA"/>
		<stop  offset="0.3337" style="stop-color:#FF76EA;stop-opacity:0"/>
		<stop  offset="0.9635" style="stop-color:#FFFFFF;stop-opacity:0"/>
	</linearGradient>
	<path style="fill:url(#SVGID_00000014625782862291518850000013807414568797167271_);fill-opacity:0.9;" d="M325.3,370.1
		c12.9-7.8,29.1-7.9,42.2-0.4L486.1,438c6.7,3.8,6.7,13.5,0,17.3l-119,68.9c-12.9,7.5-28.8,7.4-41.6,0l-115.9-67.1
		c-6.6-3.8-6.7-13.3-0.1-17.2L325.3,370.1z"/>
</g>
<g>
	
		<radialGradient id="circle-white-shadow_00000019660760097416238410000007330503051535573632_" cx="546.8525" cy="-12.8928" r="1.0002" gradientTransform="matrix(51.185 2.8699 -0.9742 17.3747 -27655.707 -894.2475)" gradientUnits="userSpaceOnUse">
		<stop  offset="0" style="stop-color:#222222"/>
		<stop  offset="1" style="stop-color:#000000;stop-opacity:0"/>
	</radialGradient>
	
		<path id="circle-white-shadow" style="fill:url(#circle-white-shadow_00000019660760097416238410000007330503051535573632_);fill-opacity:0.2;" d="
		M347.5,469.6c30.1,0,54.5-8.3,54.5-18.5s-24.4-18.5-54.5-18.5s-54.5,8.3-54.5,18.5C293,461.4,317.4,469.6,347.5,469.6z"/>
</g>
<g>
	
		<linearGradient id="SVGID_00000137115765001334246540000008195578303202039708_" gradientUnits="userSpaceOnUse" x1="323.75" y1="381.5999" x2="323.75" y2="515.0999" gradientTransform="matrix(1 0 0 1 0 451.0001)">
		<stop  offset="0" style="stop-color:#1B1D22"/>
		<stop  offset="0.5104" style="stop-color:#252932"/>
		<stop  offset="1" style="stop-color:#1B1D22"/>
	</linearGradient>
	<path style="fill:url(#SVGID_00000137115765001334246540000008195578303202039708_);fill-opacity:0.8;" d="M137.5,853.2v-18.6
		l185,103.3L510,832.6v18.6c0,3.6-1.9,6.9-5,8.6l-155.4,90.5c-16.8,9.8-37.5,9.8-54.2,0.1l-152.9-88.6
		C139.4,860.1,137.5,856.8,137.5,853.2z"/>
</g>
<linearGradient id="SVGID_00000170999540554851649160000005753244361478314636_" gradientUnits="userSpaceOnUse" x1="323.75" y1="368.7999" x2="323.75" y2="502.2999" gradientTransform="matrix(1 0 0 1 0 451.0001)">
	<stop  offset="0" style="stop-color:#1B1D22"/>
	<stop  offset="0.5104" style="stop-color:#252932"/>
	<stop  offset="1" style="stop-color:#1B1D22"/>
</linearGradient>
<path style="fill:url(#SVGID_00000170999540554851649160000005753244361478314636_);" d="M137.5,840.4v-18.6l185,103.3L510,819.8
	v18.6c0,3.6-1.9,6.9-5,8.6l-155.4,90.5c-16.8,9.8-37.5,9.8-54.2,0.1L142.5,849C139.4,847.2,137.5,843.9,137.5,840.4z"/>
<path class="st16" d="M294.5,719.8c16.8-10.1,37.8-10.3,54.8-0.5l154.2,88.9c8.7,5,8.7,17.5,0,22.5l-154.7,89.5
	c-16.7,9.7-37.4,9.7-54.1,0L144,832.9c-8.6-5-8.7-17.3-0.2-22.4L294.5,719.8z"/>
<g id="small-block-1">
	
		<linearGradient id="SVGID_00000099647580805310193930000012105046691320561038_" gradientUnits="userSpaceOnUse" x1="323.8" y1="355.1" x2="323.8" y2="442.3561" gradientTransform="matrix(1 0 0 1 0 451.0001)">
		<stop  offset="0" style="stop-color:#1F2125"/>
		<stop  offset="0.5104" style="stop-color:#1D2026"/>
		<stop  offset="1" style="stop-color:#21232B"/>
	</linearGradient>
	<path style="fill:url(#SVGID_00000099647580805310193930000012105046691320561038_);" d="M202.1,819.5v-12.1L323,874.9l122.5-68.8
		v12.1c0,2.3-1.2,4.5-3.2,5.6L340.7,883c-11,6.4-24.5,6.4-35.5,0l-99.9-57.9C203.3,824,202.1,821.9,202.1,819.5z"/>
	<path class="st18" d="M304.7,740.7c11-6.6,24.7-6.7,35.8-0.3l100.8,58.1c5.7,3.3,5.7,11.4,0,14.7l-101.1,58.5
		c-10.9,6.3-24.4,6.3-35.4,0l-98.5-57.1c-5.6-3.2-5.7-11.3-0.1-14.6L304.7,740.7z"/>
</g>
<g>
	
		<linearGradient id="SVGID_00000079447519936922460490000001495720634380724406_" gradientUnits="userSpaceOnUse" x1="625.45" y1="193.3999" x2="625.45" y2="369.2489" gradientTransform="matrix(1 0 0 1 0 451.0001)">
		<stop  offset="0" style="stop-color:#1B1D22"/>
		<stop  offset="0.5104" style="stop-color:#252932"/>
		<stop  offset="1" style="stop-color:#1B1D22"/>
	</linearGradient>
	<path style="fill:url(#SVGID_00000079447519936922460490000001495720634380724406_);fill-opacity:0.8;" d="M380.1,671.4V647
		l243.7,136.1l247-138.7v24.5c0,4.7-2.5,9-6.5,11.4L659.5,799.4c-22.1,12.9-49.3,12.9-71.5,0.1L386.7,682.8
		C382.6,680.5,380.1,676.1,380.1,671.4z"/>
</g>
<linearGradient id="SVGID_00000122709348575411052870000005148448413631014843_" gradientUnits="userSpaceOnUse" x1="624.85" y1="171.2999" x2="624.85" y2="347.1489" gradientTransform="matrix(1 0 0 1 0 451.0001)">
	<stop  offset="0" style="stop-color:#1B1D22"/>
	<stop  offset="0.5104" style="stop-color:#252932"/>
	<stop  offset="1" style="stop-color:#1B1D22"/>
</linearGradient>
<path style="fill:url(#SVGID_00000122709348575411052870000005148448413631014843_);" d="M379.5,649.3v-24.4L623.2,761l247-138.7
	v24.5c0,4.7-2.5,9-6.5,11.4l-204.8,119c-22.1,12.9-49.3,12.9-71.5,0.1L386.1,660.7C382,658.3,379.5,654,379.5,649.3z"/>
<path class="st4" d="M586.3,490.4c22.2-13.3,49.8-13.6,72.2-0.7l203.1,117c11.4,6.6,11.4,23.1,0,29.7l-203.8,118
	c-22.1,12.8-49.2,12.8-71.3,0L388,639.4c-11.3-6.5-11.4-22.8-0.2-29.5L586.3,490.4z"/>
<linearGradient id="SVGID_00000168077901041472847240000004271255716534551225_" gradientUnits="userSpaceOnUse" x1="624.9" y1="144.9999" x2="624.9" y2="282.9161" gradientTransform="matrix(1 0 0 1 0 451.0001)">
	<stop  offset="0" style="stop-color:#1F2125"/>
	<stop  offset="0.5104" style="stop-color:#1D2026"/>
	<stop  offset="1" style="stop-color:#21232B"/>
</linearGradient>
<path style="fill:url(#SVGID_00000168077901041472847240000004271255716534551225_);" d="M432.5,625.2v-27.1l191.1,106.7L817.3,596
	v27.1c0,3.7-2,7.1-5.1,8.9l-160.6,93.5c-17.3,10.1-38.7,10.1-56,0.1l-157.9-91.5C434.4,632.3,432.5,628.9,432.5,625.2z"/>
<path class="st22" d="M594.7,492.7c17.4-10.5,39.1-10.7,56.6-0.5L810.6,584c9,5.2,9,18.1,0,23.3l-159.8,92.5
	c-17.3,10-38.6,10-55.9,0l-155.7-90.2c-8.8-5.1-9-17.9-0.2-23.1L594.7,492.7z"/>
<linearGradient id="SVGID_00000173843945899346990680000015275694950758204563_" gradientUnits="userSpaceOnUse" x1="625" y1="135.4999" x2="625" y2="242.8659" gradientTransform="matrix(1 0 0 1 0 451.0001)">
	<stop  offset="0" style="stop-color:#1F2125"/>
	<stop  offset="0.5104" style="stop-color:#1D2026"/>
	<stop  offset="1" style="stop-color:#21232B"/>
</linearGradient>
<path style="fill:url(#SVGID_00000173843945899346990680000015275694950758204563_);" d="M475.2,606.1v-18L624,671.2l150.8-84.7v18
	c0,2.9-1.5,5.5-4,6.9l-125,72.8c-13.5,7.8-30.1,7.9-43.6,0L479.3,613C476.7,611.6,475.2,609,475.2,606.1z"/>
<path class="st4" d="M601.5,506.1c13.5-8.1,30.4-8.3,44.1-0.4l124,71.5c7,4,7,14.1,0,18.1l-124.4,72c-13.5,7.8-30.1,7.8-43.5,0
	l-121.2-70.2c-6.9-4-7-13.9-0.2-18L601.5,506.1z"/>
<path class="st24" d="M609.5,640.9c9,5.4,20.1,5.5,29.2,0.3l82.1-47.3c4.6-2.7,4.6-9.3,0-12l-82.4-47.7c-8.9-5.2-19.9-5.2-28.8,0
	l-80.3,46.5c-4.6,2.6-4.6,9.2-0.1,11.9L609.5,640.9z"/>
<linearGradient id="SVGID_00000114772298259543342010000003680391910269388694_" gradientUnits="userSpaceOnUse" x1="625.1969" y1="145.938" x2="625.1969" y2="74.808" gradientTransform="matrix(1 0 0 1 0 451.0001)">
	<stop  offset="0" style="stop-color:#3A9EE7"/>
	<stop  offset="1.000000e-04" style="stop-color:#69D1F2"/>
	<stop  offset="0.5104" style="stop-color:#69D1F2"/>
	<stop  offset="1" style="stop-color:#69D1F2"/>
</linearGradient>
<path style="fill:url(#SVGID_00000114772298259543342010000003680391910269388694_);" d="M525.9,585.6c0.1,2.7,0.1,1.5,0.4,3.5
	l84.4-46.7c8.5-4.7,18.8-4.7,27.3,0.1l85.7,48.2c0.6-1.1,0.7-1.7,0.8-3.9c0-1.9-1-3.6-2.6-4.6l-83.1-48.1
	c-8.9-5.1-19.8-5.2-28.7-0.1l-81.5,46.7C526.9,581.8,525.8,583.6,525.9,585.6z"/>
<g class="st26">
	<path class="st27" d="M725,284.1H526.5l-0.5,289c0,3.9,3.1,7,7,7l192,0.5V284.1z"/>
</g>
<image style="overflow:visible;" width="1153" height="1156" xlink:href="images/kubit-Logo.png" transform="matrix(0.1292 0 0 0.1292 553.6458 305.2101)">
                  </image>
<linearGradient id="paint21_linear" gradientUnits="userSpaceOnUse" x1="625.1043" y1="-151.8642" x2="625.3543" y2="202.6358" gradientTransform="matrix(1 0 0 1 0 451.0001)">
	<stop  offset="0" style="stop-color:#94E3FF;stop-opacity:0"/>
	<stop  offset="0.7714" style="stop-color:#94E3FF"/>
</linearGradient>
<path style="fill:url(#paint21_linear);" d="M526.5,283.6h198v303c0,2.5-1.3,4.8-3.5,6
	l-47,27.5l-35.6,21c-8.9,5.2-19.9,5.2-28.8-0.2l-80.3-48.8c-2.1-1.3-3.4-3.5-3.4-6L526.5,283.6z"/>
<linearGradient id="SVGID_00000014598304943597606920000009266105621900369080_" gradientUnits="userSpaceOnUse" x1="907.75" y1="342.7999" x2="907.75" y2="476.2999" gradientTransform="matrix(1 0 0 1 0 451.0001)">
	<stop  offset="0" style="stop-color:#1B1D22"/>
	<stop  offset="0.5104" style="stop-color:#252932"/>
	<stop  offset="1" style="stop-color:#1B1D22"/>
</linearGradient>
<path style="fill:url(#SVGID_00000014598304943597606920000009266105621900369080_);" d="M721.5,814.4v-18.6l185,103.3L1094,793.8
	v18.6c0,3.6-1.9,6.9-5,8.6l-155.4,90.5c-16.8,9.8-37.5,9.8-54.2,0.1L726.5,823C723.4,821.2,721.5,817.9,721.5,814.4z"/>
<path class="st4" d="M878.5,693.8c16.8-10.1,37.8-10.3,54.8-0.5l154.2,88.9c8.7,5,8.7,17.5,0,22.5l-154.7,89.5
	c-16.7,9.7-37.4,9.7-54.1,0L728,806.9c-8.6-5-8.7-17.3-0.2-22.4L878.5,693.8z"/>
<g>
	<path class="st30" d="M639.3,1117.3l18.5-0.4l-99.3,187.2l109.3,185.2l-18.6,0.4c-3.6,0.1-6.9-1.7-8.7-4.8l-93.8-153.4
		c-10.1-16.5-10.6-37.2-1.2-54.2l85.2-154.8C632.4,1119.4,635.7,1117.4,639.3,1117.3z"/>
</g>
<g id="small-block-3">
	<path class="st6" d="M764.5,795.8v-11.3L906.8,864l144.2-81v11.3c0,2.7-1.5,5.3-3.8,6.6l-119.6,69.6c-12.9,7.5-28.8,7.5-41.7,0
		l-117.5-68C766,801.1,764.5,798.6,764.5,795.8z"/>
	
		<linearGradient id="SVGID_00000034061737005247010170000003873612457870534037_" gradientUnits="userSpaceOnUse" x1="898.402" y1="464.1853" x2="913.444" y2="262.0013" gradientTransform="matrix(1 0 0 1 0 451.0001)">
		<stop  offset="0" style="stop-color:#FF76EA"/>
		<stop  offset="1" style="stop-color:#2AF6FF"/>
	</linearGradient>
	<path style="fill:url(#SVGID_00000034061737005247010170000003873612457870534037_);fill-opacity:0.8;" d="M764.5,795.8v-11.3
		L906.8,864l144.2-81v11.3c0,2.7-1.5,5.3-3.8,6.6l-119.6,69.6c-12.9,7.5-28.8,7.5-41.7,0l-117.5-68
		C766,801.1,764.5,798.6,764.5,795.8z"/>
	<g>
		
			<linearGradient id="SVGID_00000007423156934323715720000009934513132939407232_" gradientUnits="userSpaceOnUse" x1="900.9033" y1="469.1681" x2="915.9453" y2="266.9831" gradientTransform="matrix(1 0 0 1 0 451.0001)">
			<stop  offset="0" style="stop-color:#FF76EA"/>
			<stop  offset="1" style="stop-color:#2AF6FF"/>
		</linearGradient>
		<path style="fill:url(#SVGID_00000007423156934323715720000009934513132939407232_);fill-opacity:0.8;" d="M767,800.8v-11.3
			L909.3,869l144.2-81v11.3c0,2.7-1.5,5.3-3.8,6.6l-119.5,69.6c-12.9,7.5-28.8,7.5-41.7,0l-117.7-68
			C768.5,806.1,767,803.6,767,800.8z"/>
	</g>
	<path class="st9" d="M885.3,706.1c12.9-7.8,29.1-7.9,42.2-0.4l118.6,68.3c6.7,3.8,6.7,13.5,0,17.3l-119,68.9
		c-12.9,7.5-28.8,7.5-41.6,0l-115.9-67.1c-6.6-3.8-6.7-13.3-0.1-17.2L885.3,706.1z"/>
	
		<radialGradient id="SVGID_00000123411194466480497860000007047076249106341801_" cx="559.2045" cy="2.6888" r="1.0007" gradientTransform="matrix(-162.4969 139.0309 -134.7733 -157.5207 92139.2578 -76539.6094)" gradientUnits="userSpaceOnUse">
		<stop  offset="0" style="stop-color:#A0D7F1"/>
		<stop  offset="0.9931" style="stop-color:#DE4FFB"/>
	</radialGradient>
	<path style="fill:url(#SVGID_00000123411194466480497860000007047076249106341801_);fill-opacity:0.5;" d="M885.3,706.1
		c12.9-7.8,29.1-7.9,42.2-0.4l118.6,68.3c6.7,3.8,6.7,13.5,0,17.3l-119,68.9c-12.9,7.5-28.8,7.5-41.6,0l-115.9-67.1
		c-6.6-3.8-6.7-13.3-0.1-17.2L885.3,706.1z"/>
	
		<radialGradient id="SVGID_00000173872554458990254340000009980309435929430193_" cx="559.5692" cy="2.5716" r="1.0007" gradientTransform="matrix(-174.4969 114.031 -110.5387 -169.1528 98835.2188 -62589.6758)" gradientUnits="userSpaceOnUse">
		<stop  offset="0" style="stop-color:#78C8F8"/>
		<stop  offset="0.68" style="stop-color:#FFFFFF"/>
	</radialGradient>
	<path style="fill:url(#SVGID_00000173872554458990254340000009980309435929430193_);fill-opacity:0.6;" d="M885.3,706.1
		c12.9-7.8,29.1-7.9,42.2-0.4l118.6,68.3c6.7,3.8,6.7,13.5,0,17.3l-119,68.9c-12.9,7.5-28.8,7.5-41.6,0l-115.9-67.1
		c-6.6-3.8-6.7-13.3-0.1-17.2L885.3,706.1z"/>
	
		<linearGradient id="SVGID_00000164473793016122349350000012302597217418748861_" gradientUnits="userSpaceOnUse" x1="876.0451" y1="510.4285" x2="959.308" y2="44.9595" gradientTransform="matrix(1 0 0 1 0 451.0001)">
		<stop  offset="0" style="stop-color:#FF76EA"/>
		<stop  offset="0.3337" style="stop-color:#FF76EA;stop-opacity:0"/>
		<stop  offset="0.9635" style="stop-color:#FFFFFF;stop-opacity:0"/>
	</linearGradient>
	<path style="fill:url(#SVGID_00000164473793016122349350000012302597217418748861_);fill-opacity:0.9;" d="M885.3,706.1
		c12.9-7.8,29.1-7.9,42.2-0.4l118.6,68.3c6.7,3.8,6.7,13.5,0,17.3l-119,68.9c-12.9,7.5-28.8,7.5-41.6,0l-115.9-67.1
		c-6.6-3.8-6.7-13.3-0.1-17.2L885.3,706.1z"/>
</g>
<g>
	
		<radialGradient id="circle-black-shadow_00000133513823949981214950000010401012243702948490_" cx="546.8522" cy="-12.892" r="1" gradientTransform="matrix(51.185 2.8699 -0.9742 17.3747 -27095.3926 -557.1166)" gradientUnits="userSpaceOnUse">
		<stop  offset="0" style="stop-color:#222222"/>
		<stop  offset="1" style="stop-color:#000000;stop-opacity:0"/>
	</radialGradient>
	
		<path id="circle-black-shadow" style="fill:url(#circle-black-shadow_00000133513823949981214950000010401012243702948490_);fill-opacity:0.4;" d="
		M907.8,806.8c30.1,0,54.5-8.3,54.5-18.5s-24.4-18.5-54.5-18.5s-54.5,8.3-54.5,18.5S877.7,806.8,907.8,806.8z"/>
	
		<radialGradient id="circle-black_00000177482188205641551790000011124209713377895552_" cx="549.6486" cy="-3.8314" r="1" gradientTransform="matrix(66.815 0 0 66.815 -35839.9414 945.6484)" gradientUnits="userSpaceOnUse">
		<stop  offset="0" style="stop-color:#424242"/>
		<stop  offset="1" style="stop-color:#181818"/>
	</radialGradient>
	<path id="circle-black" style="fill:url(#circle-black_00000177482188205641551790000011124209713377895552_);" d="M907.8,788.3
		c36.9,0,66.8-29.9,66.8-66.8s-29.9-66.8-66.8-66.8S841,684.5,841,721.5S870.9,788.3,907.8,788.3z"/>
</g>
<g>
	<path class="st38" d="M764.6,497.9l-7.7,13.3c-1.3,2.3-2.9,3.6-4.8,4.1s-4,0.1-6.1-1.1c-2.3-1.3-3.7-3-4.4-5.1
		c-0.6-2.1-0.2-4.3,1.1-6.7l5.5,3.2c-0.9,1.6-0.8,2.7,0.4,3.4c1,0.6,1.9,0.2,2.7-1.1l7.7-13.3L764.6,497.9z"/>
	<path class="st38" d="M796.3,516.2l-16.6,17.3l-6.9-4l4.4-13.9l-10,10.7l-6.9-4l6.7-23l6.1,3.5l-5.6,15.1l11.1-11.9l6.1,3.5
		l-4.8,15.4l10.2-12.3L796.3,516.2z"/>
	<path class="st38" d="M813.8,526.3l-2.6,4.5l-5.4-3.1l-9.1,15.7l-5.6-3.2l9.1-15.7l-5.3-3.1l2.6-4.5L813.8,526.3z"/>
	<path class="st38" d="M807.9,548.7c-0.9-1.4-1.3-2.9-1.3-4.6s0.5-3.3,1.4-5c1-1.7,2.2-2.9,3.6-3.7c1.4-0.8,3-1.2,4.7-1.1
		c1.7,0.1,3.3,0.6,4.9,1.5c1.6,0.9,2.8,2.1,3.7,3.5c0.9,1.4,1.3,2.9,1.4,4.6c0,1.7-0.5,3.3-1.4,5s-2.2,2.9-3.6,3.7
		c-1.5,0.8-3,1.2-4.7,1.1c-1.7-0.1-3.3-0.6-4.9-1.5C810,551.3,808.8,550.1,807.9,548.7z M816.9,547.6c0.9-0.3,1.6-1,2.2-2
		s0.8-2.1,0.7-2.9c-0.2-0.9-0.7-1.5-1.4-2c-0.8-0.4-1.6-0.5-2.4-0.2c-0.8,0.3-1.6,1-2.2,2c-0.6,1.1-0.9,2.1-0.7,2.9
		c0.2,0.9,0.6,1.5,1.4,2C815.2,547.8,816.1,547.9,816.9,547.6z"/>
	<path class="st38" d="M832.5,564l-0.6-9.1l-3.8,6.6l-5.6-3.2l12.2-21.1l5.6,3.2l-6.6,11.4l8.1-3.7l6.7,3.9l-11,4.4l1.8,11.7
		L832.5,564z"/>
	<path class="st38" d="M860.2,570.7l-10.6-6.1c-0.4,0.9-0.6,1.7-0.4,2.4c0.2,0.7,0.6,1.2,1.3,1.6c0.9,0.5,1.8,0.5,2.7-0.1l6,3.4
		c-0.9,1-1.9,1.7-3.2,2.1c-1.2,0.5-2.5,0.6-3.9,0.5c-1.4-0.1-2.7-0.6-4-1.3c-1.6-0.9-2.8-2.1-3.6-3.4c-0.8-1.4-1.3-2.9-1.2-4.5
		c0-1.6,0.5-3.3,1.5-5s2.2-2.9,3.5-3.8c1.4-0.8,2.9-1.2,4.5-1.2s3.2,0.5,4.8,1.5c1.6,0.9,2.8,2,3.6,3.4c0.8,1.4,1.3,2.8,1.2,4.4
		c0,1.6-0.5,3.2-1.4,4.9C860.8,569.9,860.5,570.3,860.2,570.7z M856.1,564.8c0.4-0.7,0.5-1.4,0.2-2c-0.2-0.7-0.7-1.2-1.4-1.6
		c-0.7-0.4-1.4-0.5-2-0.4c-0.7,0.1-1.3,0.5-1.8,1.1L856.1,564.8z"/>
	<path class="st38" d="M881.7,573.3c0.4,1.9,0,3.8-1.2,5.9l-5.4,9.3l-5.6-3.2l5-8.6c0.5-0.9,0.7-1.8,0.5-2.6s-0.7-1.4-1.5-1.9
		s-1.6-0.6-2.4-0.4c-0.8,0.2-1.4,0.8-2,1.7l-5,8.6l-5.6-3.2l9.3-16l5.6,3.2l-1.3,2.3c0.9-0.4,1.9-0.6,3-0.6s2.2,0.4,3.3,1
		C880.2,569.9,881.4,571.4,881.7,573.3z"/>
</g>
<g>
	<path class="st9" d="M337.8,755.5l-15.3,9.1l-1.2-0.7l11.4-6.8l-14.4,4.9l-0.8-0.5l8.6-8.6l-11.6,6.8l-1.2-0.7l15.4-9l1.2,0.8
		l-9.4,9.5l15.9-5.4L337.8,755.5z"/>
	<path class="st9" d="M326.3,766.2c0-0.6,0.3-1.3,1-2.1s1.6-1.5,2.9-2.2c1.2-0.7,2.5-1.3,3.7-1.7c1.3-0.4,2.4-0.5,3.4-0.5
		s1.9,0.3,2.5,0.7c0.7,0.4,1,0.9,1,1.6c0,0.6-0.3,1.3-0.9,2.1c-0.6,0.7-1.6,1.5-2.8,2.2c-1.2,0.7-2.5,1.3-3.8,1.7s-2.4,0.5-3.5,0.5
		s-1.9-0.2-2.6-0.7C326.7,767.4,326.3,766.9,326.3,766.2z M330.8,767.1c0.7,0,1.5-0.1,2.4-0.4c0.9-0.3,1.8-0.7,2.8-1.3
		s1.7-1.1,2.1-1.7c0.5-0.5,0.7-1,0.6-1.4c0-0.4-0.2-0.8-0.7-1c-0.4-0.3-1-0.4-1.6-0.4c-0.7,0-1.5,0.1-2.3,0.4
		c-0.9,0.3-1.8,0.7-2.8,1.3s-1.7,1.1-2.2,1.7c-0.5,0.5-0.7,1-0.7,1.4s0.2,0.7,0.6,1C329.5,767,330.1,767.1,330.8,767.1z"/>
	<path class="st9" d="M346.3,765.3c0.9,0,1.6,0.2,2.2,0.6c0.6,0.4,0.9,0.9,0.9,1.5s-0.3,1.3-1,2c-0.6,0.7-1.6,1.5-2.8,2.2
		c-1.2,0.7-2.4,1.3-3.6,1.7s-2.4,0.6-3.4,0.6s-1.8-0.2-2.5-0.6c-0.6-0.4-0.9-0.8-0.9-1.4c0-0.6,0.2-1.1,0.7-1.7l-2.2,1.3l-1.2-0.7
		l16.1-9.7l1.1,0.7l-6.4,3.8C344.5,765.4,345.4,765.3,346.3,765.3z M346.5,769.2c0.5-0.5,0.7-1,0.7-1.4s-0.2-0.8-0.6-1
		c-0.4-0.3-1-0.4-1.7-0.4s-1.5,0.1-2.4,0.4c-0.9,0.3-1.8,0.7-2.7,1.2c-0.9,0.5-1.6,1.1-2.1,1.6s-0.7,1-0.7,1.5c0,0.4,0.2,0.8,0.6,1
		c0.4,0.3,1,0.4,1.7,0.4s1.5-0.1,2.4-0.4c0.9-0.3,1.8-0.7,2.7-1.2C345.4,770.3,346.1,769.7,346.5,769.2z"/>
	<path class="st9" d="M355.4,767.5c0.1-0.2,0.3-0.5,0.7-0.7c0.4-0.2,0.8-0.4,1.2-0.4c0.4-0.1,0.7,0,0.9,0.1c0.2,0.1,0.3,0.3,0.1,0.6
		s-0.4,0.5-0.7,0.7c-0.4,0.2-0.8,0.4-1.2,0.4c-0.4,0.1-0.7,0-0.9-0.1C355.3,768,355.3,767.8,355.4,767.5z M354.2,769.6l-11.9,7.2
		l-1.1-0.7l11.9-7.2L354.2,769.6z"/>
	<path class="st9" d="M361.3,769l-15.9,9.7l-1.1-0.7l15.9-9.7L361.3,769z"/>
	<path class="st9" d="M358.7,780.6l-5.4-3.4c-1.1,0.7-1.8,1.4-2,2.1c-0.2,0.7-0.1,1.2,0.5,1.6c0.5,0.3,1.1,0.4,1.8,0.4
		c0.7,0,1.5-0.2,2.3-0.5l1.2,0.8c-1.3,0.6-2.6,0.9-3.9,1s-2.3-0.1-3.1-0.6c-0.6-0.4-1-0.9-1-1.5s0.3-1.3,0.9-2.1s1.6-1.5,2.8-2.2
		c1.2-0.7,2.4-1.3,3.6-1.7s2.3-0.6,3.3-0.6s1.8,0.2,2.5,0.6c0.6,0.4,1,0.9,1,1.5s-0.3,1.3-0.8,1.9c-0.6,0.7-1.4,1.4-2.5,2
		C359.5,780.1,359.1,780.4,358.7,780.6z M360.8,777.6c0.3-0.4,0.5-0.9,0.4-1.2c0-0.4-0.3-0.7-0.7-0.9c-0.6-0.4-1.4-0.5-2.4-0.3
		c-1,0.1-2.1,0.5-3.3,1.2l4.3,2.7C359.9,778.5,360.4,778,360.8,777.6z"/>
	<path class="st9" d="M379.7,781.7l-14.6,9.2l-1.1-0.7l6.7-4.2l-4.3-2.7l-6.7,4.2l-1.1-0.7l14.8-9.2l1.1,0.7l-6.4,4l4.3,2.7l6.4-4
		L379.7,781.7z"/>
	<path class="st9" d="M378.1,792.6l-5.3-3.3c-1.1,0.7-1.8,1.4-2,2.1c-0.2,0.7,0,1.2,0.5,1.5s1.1,0.4,1.8,0.4c0.7,0,1.4-0.2,2.2-0.6
		l1.2,0.7c-1.3,0.6-2.5,0.9-3.8,1c-1.2,0.1-2.2-0.1-3-0.6c-0.6-0.4-1-0.9-1-1.5s0.3-1.3,0.9-2.1c0.6-0.7,1.5-1.5,2.7-2.3
		c1.2-0.7,2.4-1.3,3.5-1.7c1.2-0.4,2.2-0.6,3.2-0.6s1.8,0.2,2.4,0.6c0.6,0.4,0.9,0.9,1,1.5c0,0.6-0.3,1.2-0.8,1.9
		c-0.6,0.7-1.4,1.4-2.4,2C378.9,792.2,378.5,792.4,378.1,792.6z M380.1,789.6c0.3-0.4,0.5-0.9,0.4-1.2c0-0.4-0.3-0.7-0.7-0.9
		c-0.6-0.3-1.3-0.5-2.3-0.3c-1,0.1-2.1,0.5-3.2,1.2l4.2,2.6C379.2,790.5,379.7,790.1,380.1,789.6z"/>
	<path class="st9" d="M383.4,791.1c1.1-0.4,2.2-0.6,3.2-0.6s1.7,0.2,2.3,0.5c0.6,0.4,0.9,0.8,0.9,1.3s-0.2,1.1-0.7,1.6l2.1-1.3
		l1.1,0.7l-11.3,7.3l-1.1-0.7l2.1-1.4c-0.9,0.3-1.8,0.4-2.6,0.5c-0.9,0-1.6-0.2-2.2-0.5c-0.6-0.4-0.9-0.9-0.9-1.5s0.4-1.3,1-2
		s1.5-1.5,2.7-2.2C381,792.1,382.2,791.5,383.4,791.1z M387.4,794.7c0.4-0.5,0.6-1,0.6-1.4s-0.2-0.8-0.6-1c-0.4-0.3-0.9-0.4-1.6-0.4
		s-1.4,0.1-2.3,0.4c-0.8,0.3-1.7,0.7-2.5,1.2c-0.9,0.6-1.5,1.1-2,1.6c-0.4,0.5-0.7,1-0.7,1.5c0,0.4,0.2,0.8,0.6,1
		c0.4,0.3,1,0.4,1.6,0.4c0.7,0,1.4-0.2,2.3-0.4c0.8-0.3,1.7-0.7,2.6-1.3C386.3,795.8,387,795.3,387.4,794.7z"/>
	<path class="st9" d="M399,792.7l-15.2,9.8l-1.1-0.7l15.2-9.8L399,792.7z"/>
	<path class="st9" d="M396.8,798.2l-6.6,4.3c-0.5,0.4-0.9,0.7-1,0.9s0,0.5,0.4,0.7l0.8,0.5l-1.6,1l-1-0.6c-0.6-0.4-0.8-0.8-0.6-1.3
		c0.2-0.5,0.8-1.1,1.9-1.8l6.6-4.3l-0.8-0.5l1.5-1l0.8,0.5l2.8-1.8l1.1,0.7l-2.8,1.8l1.7,1.1l-1.5,1L396.8,798.2z"/>
	<path class="st9" d="M405.5,802.2c0,0.5-0.2,1-0.7,1.6s-1.2,1.3-2.3,1.9l-6.6,4.3l-1.1-0.7l6.3-4.1c1.1-0.7,1.8-1.4,2.1-2
		c0.3-0.6,0.1-1.1-0.4-1.4c-0.6-0.4-1.3-0.4-2.3-0.3c-0.9,0.2-2,0.7-3.2,1.4l-6.2,4.1l-1.1-0.7l15.1-9.8l1.1,0.7l-5.5,3.6
		c0.8-0.2,1.5-0.3,2.2-0.3s1.3,0.2,1.7,0.5C405.2,801.3,405.5,801.7,405.5,802.2z"/>
	<path class="st9" d="M348.2,795.5l-2.7-1.6l-4.7,2.9l-1.1-0.7l4.7-2.9l-2.7-1.6l1.7-1l2.7,1.6l4.7-2.9l1.1,0.7l-4.7,2.9l2.7,1.6
		L348.2,795.5z"/>
	<path class="st9" d="M261,775.9c-0.1-0.5,0.1-1.1,0.5-1.6c0.4-0.6,1.1-1.1,2-1.7l1.3,0.8c-0.7,0.5-1.2,1-1.4,1.5
		c-0.2,0.5,0,0.9,0.6,1.3c0.6,0.4,1.3,0.5,2.2,0.4c0.9-0.1,1.7-0.4,2.5-0.9c0.6-0.4,1.1-0.7,1.3-1.1c0.2-0.3,0.3-0.7,0.2-1
		c-0.1-0.3-0.3-0.7-0.5-1.1c-0.3-0.5-0.6-1-0.6-1.4c-0.1-0.4,0-0.8,0.4-1.4c0.3-0.5,1-1.1,2.1-1.7c0.9-0.5,1.8-0.9,2.8-1.1
		c1-0.2,1.9-0.3,2.7-0.3c0.8,0.1,1.6,0.3,2.2,0.7c0.9,0.5,1.2,1.2,1,2s-0.9,1.6-2.1,2.3l-1.3-0.8c0.6-0.4,1-0.8,1.1-1.3
		s-0.1-0.9-0.6-1.2s-1.2-0.4-2-0.4c-0.8,0.1-1.6,0.4-2.4,0.8c-0.6,0.3-1,0.7-1.2,1s-0.2,0.6-0.2,0.9c0.1,0.3,0.3,0.7,0.5,1.1
		c0.3,0.5,0.5,1,0.6,1.4s0,0.9-0.4,1.4c-0.3,0.5-1,1.1-2.1,1.7c-0.8,0.5-1.7,0.8-2.7,1.1s-1.9,0.4-2.8,0.4s-1.7-0.2-2.4-0.6
		C261.4,776.8,261.1,776.4,261,775.9z"/>
	<path class="st9" d="M269.2,780.5c0-0.7,0.3-1.4,1-2.2s1.7-1.6,3.1-2.4c1.3-0.8,2.7-1.4,4-1.8c1.3-0.4,2.6-0.6,3.7-0.6
		s2,0.2,2.7,0.7c0.7,0.4,1.1,1,1.1,1.6c0,0.7-0.3,1.4-1,2.2s-1.7,1.6-3,2.4c-1.3,0.8-2.7,1.4-4,1.8c-1.4,0.4-2.6,0.6-3.7,0.6
		s-2.1-0.2-2.8-0.7C269.6,781.7,269.2,781.2,269.2,780.5z M274,781.5c0.8,0,1.6-0.1,2.6-0.4c1-0.3,2-0.7,3-1.3s1.8-1.2,2.3-1.8
		s0.7-1.1,0.7-1.5s-0.3-0.8-0.7-1c-0.4-0.3-1-0.4-1.8-0.4c-0.7,0-1.6,0.1-2.5,0.4c-1,0.3-1.9,0.7-3,1.3s-1.8,1.2-2.4,1.8
		c-0.5,0.6-0.8,1.1-0.7,1.5c0,0.4,0.2,0.8,0.7,1C272.6,781.3,273.2,781.4,274,781.5z"/>
	<path class="st9" d="M285.9,779.4c1.3-0.4,2.5-0.6,3.6-0.6s2,0.2,2.7,0.6c0.9,0.5,1.2,1.2,1.1,2c-0.2,0.8-0.9,1.7-2,2.6l-1.3-0.8
		c0.7-0.5,1-1,1.1-1.5s-0.1-0.9-0.7-1.2c-0.7-0.4-1.7-0.5-2.9-0.3c-1.3,0.2-2.7,0.8-4.2,1.7c-1.6,0.9-2.5,1.8-3,2.5
		c-0.4,0.8-0.3,1.3,0.4,1.8c0.5,0.3,1.2,0.5,2,0.4c0.8,0,1.7-0.3,2.6-0.7l1.3,0.8c-1.5,0.7-3,1.1-4.3,1.2c-1.4,0.1-2.5-0.1-3.4-0.6
		c-0.7-0.4-1-1-1-1.6c0-0.7,0.4-1.4,1.1-2.1c0.7-0.8,1.7-1.6,3.1-2.4C283.3,780.4,284.6,779.8,285.9,779.4z"/>
	<path class="st9" d="M299.4,781.1c0.1-0.3,0.4-0.5,0.8-0.7s0.8-0.4,1.2-0.5c0.4-0.1,0.8,0,1,0.1s0.3,0.3,0.1,0.6
		c-0.1,0.3-0.4,0.5-0.8,0.7s-0.8,0.4-1.2,0.5c-0.4,0.1-0.8,0-1-0.1S299.2,781.4,299.4,781.1z M298.1,783.3l-12.8,7.6l-1.2-0.7
		l12.8-7.6L298.1,783.3z"/>
	<path class="st9" d="M297.2,786.2c1.3-0.4,2.4-0.6,3.5-0.6s1.9,0.2,2.5,0.6c0.6,0.4,0.9,0.9,0.9,1.4c0,0.6-0.3,1.1-0.8,1.7l2.3-1.4
		l1.2,0.7l-12.6,7.6l-1.2-0.7l2.4-1.4c-1,0.3-2,0.5-2.9,0.5c-1,0-1.8-0.2-2.4-0.5c-0.6-0.4-1-0.9-0.9-1.6c0-0.6,0.4-1.4,1.1-2.2
		s1.7-1.6,3-2.3C294.7,787.2,295.9,786.6,297.2,786.2z M301.6,790c0.5-0.6,0.7-1.1,0.7-1.5c0-0.5-0.2-0.8-0.7-1.1
		c-0.4-0.3-1-0.4-1.8-0.4c-0.7,0-1.6,0.1-2.5,0.4c-0.9,0.3-1.9,0.7-2.8,1.3c-1,0.6-1.7,1.2-2.2,1.7c-0.5,0.6-0.8,1.1-0.8,1.5
		c0,0.5,0.2,0.8,0.7,1.1s1.1,0.4,1.8,0.4c0.8,0,1.6-0.2,2.5-0.5s1.9-0.7,2.8-1.3C300.4,791.1,301.1,790.5,301.6,790z"/>
	<path class="st9" d="M314.5,787.9l-17,10.3l-1.2-0.7l17-10.3L314.5,787.9z"/>
	<path class="st9" d="M315.5,794.2c1.6-0.5,3.1-0.8,4.5-0.8s2.5,0.2,3.3,0.7c1,0.6,1.4,1.4,1.3,2.3c-0.1,0.9-0.7,2-1.9,3.1l-1.4-0.8
		c0.7-0.7,1.1-1.4,1.1-2s-0.3-1.1-0.9-1.5s-1.4-0.6-2.5-0.6c-1,0-2.1,0.2-3.4,0.6c-1.2,0.4-2.5,1-3.8,1.8s-2.2,1.5-2.9,2.3
		c-0.7,0.8-1,1.4-1,2.1c0,0.6,0.3,1.1,0.9,1.5c0.7,0.4,1.5,0.6,2.5,0.6s2.1-0.3,3.3-0.7l1.4,0.8c-1.9,0.7-3.6,1.1-5.1,1.2
		c-1.6,0.1-2.9-0.2-3.9-0.8c-0.8-0.5-1.3-1.2-1.3-2s0.4-1.8,1.3-2.8c0.8-1,2-2,3.6-2.9C312.2,795.4,313.8,794.7,315.5,794.2z"/>
	<path class="st9" d="M315.1,808c0-0.7,0.3-1.4,1-2.2s1.6-1.6,2.9-2.4c1.3-0.8,2.5-1.4,3.8-1.8c1.3-0.4,2.4-0.6,3.5-0.6
		s1.9,0.2,2.6,0.6c0.7,0.4,1,0.9,1,1.6c0,0.6-0.3,1.4-0.9,2.1c-0.6,0.8-1.6,1.6-2.9,2.4c-1.3,0.8-2.5,1.4-3.8,1.8
		c-1.3,0.4-2.5,0.6-3.6,0.6s-2-0.2-2.6-0.6S315.2,808.6,315.1,808z M319.7,808.8c0.7,0,1.5-0.1,2.5-0.4c0.9-0.3,1.9-0.7,2.9-1.4
		c1-0.6,1.7-1.2,2.2-1.8s0.7-1.1,0.7-1.5s-0.2-0.8-0.7-1c-0.4-0.3-1-0.4-1.7-0.4s-1.5,0.1-2.4,0.4c-0.9,0.3-1.9,0.8-2.8,1.4
		c-1,0.6-1.8,1.2-2.2,1.8c-0.5,0.6-0.7,1-0.7,1.5c0,0.4,0.2,0.8,0.7,1C318.4,808.7,319,808.8,319.7,808.8z"/>
	<path class="st9" d="M343.3,811c0,0.5-0.2,1.1-0.7,1.7c-0.5,0.6-1.4,1.3-2.5,2l-7.1,4.5l-1.2-0.7l6.9-4.4c1.2-0.8,2-1.5,2.2-2.1
		c0.3-0.6,0.2-1.1-0.4-1.4c-0.6-0.4-1.4-0.4-2.4-0.2s-2.2,0.7-3.4,1.5l-6.7,4.2l-1.2-0.7l6.9-4.4c1.2-0.8,2-1.5,2.3-2.1
		s0.2-1.1-0.4-1.4c-0.6-0.4-1.4-0.4-2.5-0.2c-1,0.2-2.2,0.7-3.5,1.5l-6.8,4.2l-1.2-0.7l12.2-7.7l1.2,0.7l-1.8,1.1
		c0.9-0.3,1.7-0.4,2.4-0.4c0.7,0,1.3,0.2,1.8,0.5c0.6,0.4,0.9,0.8,0.9,1.4c0,0.6-0.3,1.2-1,1.9c1-0.4,2-0.6,2.9-0.7
		c0.9,0,1.6,0.1,2.2,0.5C343,810.1,343.2,810.5,343.3,811z"/>
	<path class="st9" d="M356.2,818.8c0,0.5-0.2,1.1-0.7,1.7c-0.5,0.6-1.3,1.3-2.4,2l-7,4.5l-1.1-0.7l6.8-4.4c1.2-0.8,1.9-1.5,2.2-2.1
		c0.3-0.6,0.1-1.1-0.4-1.4c-0.6-0.4-1.4-0.4-2.4-0.2s-2.1,0.7-3.4,1.5l-6.6,4.3l-1.1-0.7l6.8-4.4c1.2-0.8,1.9-1.5,2.2-2.1
		c0.3-0.6,0.1-1.1-0.4-1.4c-0.6-0.4-1.4-0.4-2.4-0.2s-2.2,0.7-3.4,1.5l-6.7,4.2l-1.2-0.7l12.1-7.7l1.1,0.7l-1.7,1.1
		c0.9-0.3,1.6-0.4,2.4-0.4c0.7,0,1.3,0.2,1.8,0.4c0.6,0.3,0.9,0.8,0.9,1.4c0,0.6-0.3,1.2-1,1.9c1-0.4,2-0.6,2.9-0.7
		c0.9,0,1.6,0.1,2.2,0.4C355.9,817.9,356.2,818.3,356.2,818.8z"/>
	<path class="st9" d="M359.3,828.5l-5.5-3.3c-1.1,0.8-1.8,1.5-2.1,2.2c-0.2,0.7-0.1,1.2,0.6,1.6c0.5,0.3,1.1,0.4,1.8,0.3
		c0.7-0.1,1.5-0.3,2.3-0.6l1.2,0.7c-1.3,0.6-2.6,1-3.9,1.2c-1.3,0.1-2.3,0-3.1-0.5c-0.7-0.4-1-0.9-1-1.5s0.3-1.3,1-2.1
		c0.6-0.8,1.6-1.6,2.8-2.4c1.2-0.8,2.4-1.4,3.6-1.8c1.2-0.4,2.3-0.6,3.3-0.7c1,0,1.8,0.2,2.5,0.6c0.6,0.4,1,0.9,1,1.5
		s-0.3,1.3-0.9,2s-1.4,1.4-2.5,2.1C360.2,828,359.8,828.3,359.3,828.5z M361.4,825.4c0.3-0.5,0.5-0.9,0.4-1.3c0-0.4-0.3-0.7-0.7-0.9
		c-0.6-0.3-1.4-0.4-2.4-0.3c-1,0.2-2.1,0.6-3.3,1.3l4.3,2.6C360.6,826.3,361.1,825.9,361.4,825.4z"/>
	<path class="st9" d="M369.1,826.6c0.7,0,1.4,0.1,1.9,0.4l-2,1.3l-0.3-0.2c-1.3-0.8-3.1-0.4-5.4,1.2l-6.4,4.2l-1.1-0.7l11.8-7.7
		l1.1,0.7l-1.9,1.2C367.6,826.8,368.4,826.6,369.1,826.6z"/>
	<path class="st9" d="M369.4,829.7c1.2-0.4,2.3-0.6,3.3-0.7c1,0,1.8,0.2,2.4,0.5c0.8,0.5,1.2,1.1,1,1.9c-0.2,0.8-0.8,1.6-1.8,2.5
		l-1.2-0.7c0.6-0.5,0.9-1,1-1.5s-0.1-0.9-0.6-1.1c-0.6-0.4-1.5-0.4-2.7-0.2c-1.2,0.3-2.4,0.9-3.8,1.8c-1.4,0.9-2.3,1.8-2.7,2.5
		c-0.4,0.7-0.2,1.3,0.4,1.7c0.5,0.3,1.1,0.4,1.8,0.3c0.7-0.1,1.5-0.3,2.4-0.7l1.2,0.7c-1.4,0.7-2.7,1.1-4,1.3s-2.3,0-3.1-0.5
		c-0.6-0.4-1-0.9-1-1.5s0.3-1.3,1-2.1c0.6-0.8,1.6-1.6,2.8-2.4C367,830.7,368.2,830.1,369.4,829.7z"/>
	<path class="st9" d="M379.1,840.4l-5.4-3.2c-1.1,0.8-1.8,1.5-2,2.2s0,1.2,0.5,1.5s1.1,0.4,1.8,0.3c0.7-0.1,1.5-0.3,2.2-0.6l1.2,0.7
		c-1.3,0.6-2.6,1-3.8,1.2c-1.2,0.1-2.3,0-3.1-0.5c-0.6-0.4-1-0.9-1-1.5s0.3-1.3,0.9-2.1s1.5-1.6,2.7-2.4c1.2-0.8,2.4-1.4,3.6-1.8
		c1.2-0.4,2.3-0.7,3.2-0.7c1,0,1.8,0.2,2.4,0.6c0.6,0.4,1,0.9,1,1.5s-0.3,1.3-0.8,2c-0.6,0.7-1.4,1.4-2.4,2.1
		C379.9,839.9,379.5,840.1,379.1,840.4z M381.1,837.3c0.3-0.5,0.5-0.9,0.4-1.3s-0.3-0.7-0.7-0.9c-0.6-0.3-1.3-0.4-2.4-0.2
		c-1,0.2-2.1,0.6-3.2,1.3l4.2,2.5C380.3,838.2,380.8,837.7,381.1,837.3z"/>
	<path class="st9" d="M310.3,821.4l-2.8-1.6l-5,3.1l-1.1-0.7l5-3.1l-2.8-1.6l1.8-1.1l2.8,1.6l5-3.1l1.1,0.7l-5,3.1l2.8,1.6
		L310.3,821.4z"/>
	<path class="st9" d="M254.2,803.2l-20.1,8.6l-1.4-0.8l11.7-9.5l-16.4,6.8l-1.5-0.8l14.7-11.8l1.4,0.8l-12.6,9.9l17.1-7.3l1.4,0.8
		l-12.4,9.9l16.7-7.4L254.2,803.2z"/>
	<path class="st9" d="M251.3,814.7l-6.1-3.5c-1.3,0.8-2.1,1.6-2.4,2.3c-0.3,0.7-0.1,1.3,0.6,1.7c0.6,0.3,1.2,0.4,2.1,0.4
		c0.8-0.1,1.7-0.3,2.6-0.6l1.4,0.8c-1.5,0.7-3,1.1-4.4,1.2c-1.4,0.1-2.6-0.1-3.5-0.6c-0.7-0.4-1.1-1-1.1-1.6c0-0.7,0.4-1.4,1.1-2.2
		c0.7-0.8,1.8-1.6,3.2-2.5c1.4-0.8,2.8-1.5,4.2-1.9s2.6-0.7,3.8-0.7c1.1,0,2.1,0.2,2.8,0.6c0.7,0.4,1.1,1,1.1,1.6
		c0,0.7-0.3,1.4-1,2.1c-0.7,0.8-1.6,1.5-2.8,2.2C252.3,814.2,251.8,814.4,251.3,814.7z M253.7,811.4c0.4-0.5,0.6-0.9,0.5-1.3
		c0-0.4-0.3-0.7-0.7-1c-0.6-0.4-1.5-0.5-2.7-0.3s-2.4,0.6-3.8,1.3l4.8,2.8C252.7,812.4,253.4,811.9,253.7,811.4z"/>
	<path class="st9" d="M266.5,809.1l-18.1,10.8l-1.3-0.7l18.1-10.8L266.5,809.1z"/>
	<path class="st9" d="M269.8,811.1l-18,10.9l-1.3-0.7l18-10.8L269.8,811.1z"/>
	<path class="st9" d="M272,819.2c-0.4,0.9-1.5,1.9-3.4,3l-7.8,4.8l-1.2-0.7l7.5-4.6c1.3-0.8,2.1-1.5,2.5-2.2
		c0.3-0.6,0.2-1.1-0.5-1.5s-1.5-0.5-2.7-0.2c-1.1,0.2-2.4,0.7-3.8,1.6l-7.4,4.5l-1.3-0.7l13.3-8.1l1.2,0.7l-1.9,1.1
		c0.9-0.3,1.8-0.4,2.6-0.4c0.8,0,1.4,0.2,2,0.5C272.1,817.6,272.4,818.3,272,819.2z"/>
	<path class="st9" d="M275.4,828.6l-6-3.4c-1.3,0.8-2,1.6-2.3,2.3s-0.1,1.3,0.6,1.6c0.5,0.3,1.2,0.4,2,0.4c0.8-0.1,1.6-0.3,2.5-0.7
		l1.3,0.8c-1.5,0.7-2.9,1.1-4.3,1.2c-1.4,0.1-2.6,0-3.4-0.6c-0.7-0.4-1.1-1-1.1-1.6c0-0.7,0.4-1.4,1.1-2.2s1.8-1.6,3.1-2.5
		c1.4-0.8,2.7-1.5,4-1.9s2.6-0.7,3.7-0.7s2,0.2,2.7,0.6c0.7,0.4,1.1,0.9,1.1,1.6c0,0.6-0.3,1.3-1,2.1s-1.6,1.5-2.8,2.2
		C276.4,828.1,275.9,828.3,275.4,828.6z M277.8,825.3c0.4-0.5,0.6-0.9,0.5-1.3c0-0.4-0.3-0.7-0.7-1c-0.6-0.4-1.5-0.5-2.6-0.3
		s-2.4,0.6-3.7,1.4l4.7,2.7C276.8,826.3,277.4,825.8,277.8,825.3z"/>
	<path class="st9" d="M272.8,833.6c-0.1-0.5,0-1,0.4-1.5s0.9-1.1,1.7-1.6l1.3,0.7c-0.6,0.4-1,0.9-1.1,1.3c-0.1,0.4,0.1,0.8,0.6,1.1
		s1,0.4,1.7,0.3c0.6-0.1,1.2-0.3,1.8-0.6c0.6-0.4,0.9-0.7,0.8-1c0-0.3-0.2-0.8-0.5-1.3s-0.5-0.9-0.6-1.3c-0.1-0.4,0-0.8,0.3-1.2
		c0.3-0.5,0.8-1,1.7-1.5c0.7-0.4,1.4-0.7,2.2-0.9c0.8-0.2,1.5-0.3,2.3-0.3c0.7,0,1.4,0.2,1.9,0.5c0.8,0.5,1.1,1.1,0.9,1.8
		s-0.9,1.5-2.2,2.3l-1.2-0.7c0.7-0.4,1-0.9,1.2-1.3c0.1-0.4,0-0.8-0.5-1c-0.4-0.3-1-0.4-1.5-0.3c-0.6,0.1-1.2,0.2-1.7,0.6
		c-0.4,0.3-0.7,0.5-0.8,0.8c-0.1,0.3-0.1,0.5-0.1,0.8c0.1,0.2,0.2,0.5,0.4,0.9c0.3,0.5,0.5,0.9,0.6,1.2s0,0.7-0.2,1.2
		c-0.3,0.4-0.8,0.9-1.6,1.4c-0.7,0.4-1.5,0.8-2.3,1s-1.6,0.3-2.3,0.3c-0.7,0-1.4-0.2-1.9-0.5C273.2,834.4,272.9,834,272.8,833.6z"/>
	<path class="st9" d="M279.9,837.6c-0.1-0.5,0-1,0.4-1.5c0.3-0.5,0.9-1.1,1.7-1.6l1.3,0.7c-0.6,0.4-1,0.9-1.1,1.3
		c-0.1,0.4,0.1,0.8,0.6,1.1s1,0.4,1.7,0.3c0.6-0.1,1.2-0.3,1.8-0.6c0.6-0.4,0.8-0.7,0.8-1s-0.2-0.8-0.5-1.3s-0.5-0.9-0.6-1.3
		c-0.1-0.4,0-0.8,0.3-1.2c0.3-0.5,0.8-1,1.6-1.5c0.7-0.4,1.4-0.7,2.2-0.9c0.8-0.2,1.5-0.3,2.3-0.3c0.7,0,1.4,0.2,1.9,0.5
		c0.8,0.5,1.1,1.1,0.9,1.8s-0.9,1.5-2.2,2.3l-1.2-0.7c0.6-0.4,1-0.9,1.2-1.3c0.1-0.4,0-0.8-0.5-1c-0.4-0.3-1-0.4-1.5-0.3
		c-0.6,0.1-1.1,0.2-1.7,0.6c-0.4,0.3-0.7,0.5-0.8,0.8s-0.1,0.5-0.1,0.8c0.1,0.2,0.2,0.5,0.4,0.9c0.3,0.5,0.5,0.9,0.5,1.2
		c0.1,0.3,0,0.7-0.2,1.2c-0.3,0.4-0.8,0.9-1.5,1.4c-0.7,0.4-1.5,0.8-2.3,1s-1.6,0.3-2.3,0.3c-0.7,0-1.4-0.2-1.9-0.5
		C280.3,838.5,280,838.1,279.9,837.6z"/>
	<path class="st9" d="M311.1,836.3l-1.7,1.1l-2.5-1.5l-14.5,9.2l-1.2-0.7l14.5-9.2l-2.5-1.5l1.7-1.1L311.1,836.3z"/>
	<path class="st9" d="M298.4,847.8c0-0.7,0.3-1.4,1-2.2s1.7-1.7,3-2.5s2.6-1.5,3.9-1.9s2.5-0.7,3.6-0.7s2,0.2,2.6,0.6
		c0.7,0.4,1,0.9,1.1,1.6c0,0.7-0.3,1.4-1,2.2s-1.6,1.6-2.9,2.5c-1.3,0.8-2.6,1.5-3.9,1.9c-1.3,0.5-2.5,0.7-3.7,0.7
		c-1.1,0-2-0.2-2.7-0.6C298.7,849,298.4,848.5,298.4,847.8z M303,848.6c0.7,0,1.6-0.2,2.5-0.5s1.9-0.8,2.9-1.5s1.8-1.3,2.2-1.9
		c0.5-0.6,0.7-1.1,0.7-1.5s-0.3-0.8-0.7-1c-0.4-0.3-1-0.4-1.7-0.4s-1.5,0.2-2.5,0.5c-0.9,0.3-1.9,0.8-2.9,1.5s-1.8,1.3-2.3,1.9
		c-0.5,0.6-0.7,1.1-0.7,1.5s0.2,0.8,0.7,1C301.7,848.5,302.3,848.6,303,848.6z"/>
	<path class="st9" d="M309,854.7l2.7-5.2l-5.6,3.6l-1.2-0.7l17-10.9l1.2,0.7l-9.9,6.4l8.3-2l1.7,1l-9.6,2.1l-2.9,6.1L309,854.7z"/>
	<path class="st9" d="M323.7,856.4l-5.7-3.3c-1.2,0.8-1.9,1.6-2.2,2.3c-0.3,0.7-0.1,1.2,0.6,1.6c0.5,0.3,1.2,0.4,1.9,0.3
		c0.8-0.1,1.6-0.3,2.4-0.7l1.3,0.7c-1.4,0.7-2.7,1.1-4.1,1.3c-1.3,0.2-2.4,0-3.3-0.5c-0.7-0.4-1-0.9-1-1.6c0-0.7,0.3-1.4,1-2.2
		s1.7-1.6,3-2.5c1.3-0.8,2.6-1.5,3.8-1.9c1.3-0.5,2.4-0.7,3.5-0.7s1.9,0.2,2.6,0.6c0.7,0.4,1,0.9,1,1.5s-0.3,1.3-0.9,2.1
		s-1.5,1.5-2.6,2.2C324.6,855.9,324.2,856.1,323.7,856.4z M326,853.1c0.4-0.5,0.5-0.9,0.5-1.3c0-0.4-0.3-0.7-0.7-0.9
		c-0.6-0.3-1.4-0.4-2.5-0.2s-2.2,0.7-3.5,1.4l4.5,2.6C325,854.1,325.6,853.6,326,853.1z"/>
	<path class="st9" d="M336.7,856.7c-0.4,0.9-1.4,1.9-3.1,3l-7.3,4.8l-1.2-0.7l7-4.6c1.2-0.8,2-1.5,2.3-2.2c0.3-0.6,0.1-1.1-0.5-1.5
		s-1.4-0.4-2.5-0.2c-1,0.2-2.2,0.8-3.5,1.6l-6.9,4.5l-1.2-0.7l12.4-8.1l1.2,0.7l-1.7,1.2c0.9-0.3,1.7-0.4,2.4-0.4
		c0.7,0,1.4,0.1,1.8,0.4C336.8,855.1,337,855.8,336.7,856.7z"/>
</g>
<g>
	<defs>
		<filter id="Adobe_OpacityMaskFilter" filterUnits="userSpaceOnUse" x="840.6" y="592.9" width="134.7" height="195.4">
			<feFlood  style="flood-color:white;flood-opacity:1" result="back"/>
			<feBlend  in="SourceGraphic" in2="back" mode="normal"/>
		</filter>
	</defs>
	
		<mask maskUnits="userSpaceOnUse" x="840.6" y="592.9" width="134.7" height="195.4" id="SVGID_00000183210796897262736540000010838698713642308480_">
		<g class="st39">
			<defs>
				
					<filter id="Adobe_OpacityMaskFilter_00000066503191523328036050000000164153216059453339_" filterUnits="userSpaceOnUse" x="840.6" y="592.9" width="134.7" height="195.4">
					<feFlood  style="flood-color:white;flood-opacity:1" result="back"/>
					<feBlend  in="SourceGraphic" in2="back" mode="normal"/>
				</filter>
			</defs>
			
				<mask maskUnits="userSpaceOnUse" x="840.6" y="592.9" width="134.7" height="195.4" id="SVGID_00000183210796897262736540000010838698713642308480_">
				<g style="filter:url(#Adobe_OpacityMaskFilter_00000066503191523328036050000000164153216059453339_);">
				</g>
			</mask>
			
				<linearGradient id="SVGID_00000013898403757337459620000005937294333782650022_" gradientUnits="userSpaceOnUse" x1="907.9682" y1="598.1005" x2="907.9682" y2="822.6811">
				<stop  offset="0" style="stop-color:#FFFFFF"/>
				<stop  offset="1" style="stop-color:#000000"/>
			</linearGradient>
			
				<path style="mask:url(#SVGID_00000183210796897262736540000010838698713642308480_);fill:url(#SVGID_00000013898403757337459620000005937294333782650022_);" d="
				M927.7,640.1l3.8-11.9c0,0,7.5-27,3.6-32.8s-8.3,3.2-20.2,7.9c-11.9,4.7-7.6-7.1-15.9-10s-10.1,12.1-16.7,8.7s-6.6-7.4-12.7,1.1
				c-5.1,7.1,12.7,29.8,18.6,37.1c0,0-51,44.9-47.5,92.6c3.4,47.4,38.5,56.4,68.4,55.5c29.4-0.2,62.7-9.4,66-55.6
				C978.5,685.6,929.1,641.1,927.7,640.1z"/>
		</g>
	</mask>
	
		<radialGradient id="SVGID_00000175324384215583817670000016848818665241678468_" cx="907.9682" cy="690.6105" r="83.9161" gradientUnits="userSpaceOnUse">
		<stop  offset="0" style="stop-color:#424242"/>
		<stop  offset="1" style="stop-color:#181818"/>
	</radialGradient>
	<path style="fill:url(#SVGID_00000175324384215583817670000016848818665241678468_);" d="M927.7,640.1l3.8-11.9
		c0,0,7.5-27,3.6-32.8s-8.3,3.2-20.2,7.9c-11.9,4.7-7.6-7.1-15.9-10s-10.1,12.1-16.7,8.7s-6.6-7.4-12.7,1.1
		c-5.1,7.1,12.7,29.8,18.6,37.1c0,0-51,44.9-47.5,92.6c3.4,47.4,38.5,56.4,68.4,55.5c29.4-0.2,62.7-9.4,66-55.6
		C978.5,685.6,929.1,641.1,927.7,640.1z"/>
	<path class="st43" d="M927.7,640.1l3.8-11.9c0,0,7.5-27,3.6-32.8s-8.3,3.2-20.2,7.9c-11.9,4.7-7.6-7.1-15.9-10s-10.1,12.1-16.7,8.7
		s-6.6-7.4-12.7,1.1c-5.1,7.1,12.7,29.8,18.6,37.1c0,0-51,44.9-47.5,92.6c3.4,47.4,38.5,56.4,68.4,55.5c29.4-0.2,62.7-9.4,66-55.6
		C978.5,685.6,929.1,641.1,927.7,640.1z"/>
	<defs>
		
			<filter id="Adobe_OpacityMaskFilter_00000070820726452193127950000004774593476114014649_" filterUnits="userSpaceOnUse" x="885.1" y="636.7" width="45" height="6.3">
			<feFlood  style="flood-color:white;flood-opacity:1" result="back"/>
			<feBlend  in="SourceGraphic" in2="back" mode="normal"/>
		</filter>
	</defs>
	
		<mask maskUnits="userSpaceOnUse" x="885.1" y="636.7" width="45" height="6.3" id="SVGID_00000060015157019961608150000015504620190327759750_">
		<g style="filter:url(#Adobe_OpacityMaskFilter_00000070820726452193127950000004774593476114014649_);">
			<defs>
				
					<filter id="Adobe_OpacityMaskFilter_00000044170639705832370720000004253360105011866539_" filterUnits="userSpaceOnUse" x="885.1" y="636.7" width="45" height="6.3">
					<feFlood  style="flood-color:white;flood-opacity:1" result="back"/>
					<feBlend  in="SourceGraphic" in2="back" mode="normal"/>
				</filter>
			</defs>
			
				<mask maskUnits="userSpaceOnUse" x="885.1" y="636.7" width="45" height="6.3" id="SVGID_00000060015157019961608150000015504620190327759750_">
				<g style="filter:url(#Adobe_OpacityMaskFilter_00000044170639705832370720000004253360105011866539_);">
				</g>
			</mask>
			
				<linearGradient id="SVGID_00000024693278394839486450000014461241220003905470_" gradientUnits="userSpaceOnUse" x1="907.6184" y1="636.8965" x2="907.6184" y2="644.1398">
				<stop  offset="0" style="stop-color:#FFFFFF"/>
				<stop  offset="1" style="stop-color:#000000"/>
			</linearGradient>
			
				<path style="mask:url(#SVGID_00000060015157019961608150000015504620190327759750_);fill:url(#SVGID_00000024693278394839486450000014461241220003905470_);" d="
				M886.3,640.1c0.4-0.5,17.9-1,27.1-2.4s16.1-1.2,16.5,0c0.4,1.2,0.6,3-1.3,3.1s-42.3,2.9-43.2,2
				C884.4,641.9,886.3,640.1,886.3,640.1z"/>
		</g>
	</mask>
	
		<linearGradient id="SVGID_00000124859329565497376160000012523230841692670599_" gradientUnits="userSpaceOnUse" x1="907.6184" y1="636.8965" x2="907.6184" y2="644.1398">
		<stop  offset="0" style="stop-color:#FFFFFF"/>
		<stop  offset="1" style="stop-color:#FFFFFF"/>
	</linearGradient>
	<path style="fill:url(#SVGID_00000124859329565497376160000012523230841692670599_);" d="M886.3,640.1c0.4-0.5,17.9-1,27.1-2.4
		s16.1-1.2,16.5,0c0.4,1.2,0.6,3-1.3,3.1s-42.3,2.9-43.2,2C884.4,641.9,886.3,640.1,886.3,640.1z"/>
	<defs>
		
			<filter id="Adobe_OpacityMaskFilter_00000145018999904200661430000008025304436282690970_" filterUnits="userSpaceOnUse" x="885.1" y="633.5" width="45" height="6.3">
			<feFlood  style="flood-color:white;flood-opacity:1" result="back"/>
			<feBlend  in="SourceGraphic" in2="back" mode="normal"/>
		</filter>
	</defs>
	
		<mask maskUnits="userSpaceOnUse" x="885.1" y="633.5" width="45" height="6.3" id="SVGID_00000009586672232490937250000009610886197424907934_">
		<g style="filter:url(#Adobe_OpacityMaskFilter_00000145018999904200661430000008025304436282690970_);">
			<defs>
				
					<filter id="Adobe_OpacityMaskFilter_00000065766091510684832990000004273359015615311024_" filterUnits="userSpaceOnUse" x="885.1" y="633.5" width="45" height="6.3">
					<feFlood  style="flood-color:white;flood-opacity:1" result="back"/>
					<feBlend  in="SourceGraphic" in2="back" mode="normal"/>
				</filter>
			</defs>
			
				<mask maskUnits="userSpaceOnUse" x="885.1" y="633.5" width="45" height="6.3" id="SVGID_00000009586672232490937250000009610886197424907934_">
				<g style="filter:url(#Adobe_OpacityMaskFilter_00000065766091510684832990000004273359015615311024_);">
				</g>
			</mask>
			
				<linearGradient id="SVGID_00000133529422246526428950000004025057743838952084_" gradientUnits="userSpaceOnUse" x1="907.6184" y1="633.7145" x2="907.6184" y2="640.9578">
				<stop  offset="0" style="stop-color:#FFFFFF"/>
				<stop  offset="1" style="stop-color:#000000"/>
			</linearGradient>
			
				<path style="mask:url(#SVGID_00000009586672232490937250000009610886197424907934_);fill:url(#SVGID_00000133529422246526428950000004025057743838952084_);" d="
				M886.3,636.9c0.4-0.5,17.9-1,27.1-2.4c9.1-1.4,16.1-1.2,16.5,0c0.4,1.2,0.6,3-1.3,3.1c-1.9,0.2-42.3,2.9-43.2,2
				C884.4,638.7,886.3,636.9,886.3,636.9z"/>
		</g>
	</mask>
	
		<linearGradient id="SVGID_00000085230097865866666470000005049621137349972631_" gradientUnits="userSpaceOnUse" x1="907.6184" y1="633.7145" x2="907.6184" y2="640.9578">
		<stop  offset="0" style="stop-color:#FFFFFF"/>
		<stop  offset="1" style="stop-color:#FFFFFF"/>
	</linearGradient>
	<path style="fill:url(#SVGID_00000085230097865866666470000005049621137349972631_);" d="M886.3,636.9c0.4-0.5,17.9-1,27.1-2.4
		c9.1-1.4,16.1-1.2,16.5,0c0.4,1.2,0.6,3-1.3,3.1c-1.9,0.2-42.3,2.9-43.2,2C884.4,638.7,886.3,636.9,886.3,636.9z"/>
	<defs>
		
			<filter id="Adobe_OpacityMaskFilter_00000080204755540933458060000006626049434042915492_" filterUnits="userSpaceOnUse" x="916.6" y="641.3" width="21.2" height="38.3">
			<feFlood  style="flood-color:white;flood-opacity:1" result="back"/>
			<feBlend  in="SourceGraphic" in2="back" mode="normal"/>
		</filter>
	</defs>
	
		<mask maskUnits="userSpaceOnUse" x="916.6" y="641.3" width="21.2" height="38.3" id="SVGID_00000028317303573702186030000002247896866861629879_">
		<g style="filter:url(#Adobe_OpacityMaskFilter_00000080204755540933458060000006626049434042915492_);">
			<defs>
				
					<filter id="Adobe_OpacityMaskFilter_00000026139066093936957280000005982789918622105219_" filterUnits="userSpaceOnUse" x="916.6" y="641.3" width="21.2" height="38.3">
					<feFlood  style="flood-color:white;flood-opacity:1" result="back"/>
					<feBlend  in="SourceGraphic" in2="back" mode="normal"/>
				</filter>
			</defs>
			
				<mask maskUnits="userSpaceOnUse" x="916.6" y="641.3" width="21.2" height="38.3" id="SVGID_00000028317303573702186030000002247896866861629879_">
				<g style="filter:url(#Adobe_OpacityMaskFilter_00000026139066093936957280000005982789918622105219_);">
				</g>
			</mask>
			
				<linearGradient id="SVGID_00000051370663782933374810000002899765133641794227_" gradientUnits="userSpaceOnUse" x1="927.2095" y1="642.3279" x2="927.2095" y2="686.3768">
				<stop  offset="0" style="stop-color:#FFFFFF"/>
				<stop  offset="1" style="stop-color:#000000"/>
			</linearGradient>
			
				<path style="mask:url(#SVGID_00000028317303573702186030000002247896866861629879_);fill:url(#SVGID_00000051370663782933374810000002899765133641794227_);" d="
				M916.6,641.5c0,0,15.8,29,14.5,34.9c0,0,0.3,4.1,4.7,3.1s2.6-13.9-15.4-38.2L916.6,641.5z"/>
		</g>
	</mask>
	
		<linearGradient id="SVGID_00000099647160194215350070000013130678062300437403_" gradientUnits="userSpaceOnUse" x1="927.2095" y1="642.3279" x2="927.2095" y2="686.3768">
		<stop  offset="0" style="stop-color:#FFFFFF"/>
		<stop  offset="1" style="stop-color:#FFFFFF"/>
	</linearGradient>
	<path style="fill:url(#SVGID_00000099647160194215350070000013130678062300437403_);" d="M916.6,641.5c0,0,15.8,29,14.5,34.9
		c0,0,0.3,4.1,4.7,3.1s2.6-13.9-15.4-38.2L916.6,641.5z"/>
	<defs>
		
			<filter id="Adobe_OpacityMaskFilter_00000139265357719181896580000010666431688952719252_" filterUnits="userSpaceOnUse" x="923.2" y="639.9" width="27.1" height="35.7">
			<feFlood  style="flood-color:white;flood-opacity:1" result="back"/>
			<feBlend  in="SourceGraphic" in2="back" mode="normal"/>
		</filter>
	</defs>
	
		<mask maskUnits="userSpaceOnUse" x="923.2" y="639.9" width="27.1" height="35.7" id="SVGID_00000119077933816074769830000017480442875640206266_">
		<g style="filter:url(#Adobe_OpacityMaskFilter_00000139265357719181896580000010666431688952719252_);">
			<defs>
				
					<filter id="Adobe_OpacityMaskFilter_00000124123104642204062600000004383802563361104298_" filterUnits="userSpaceOnUse" x="923.2" y="639.9" width="27.1" height="35.7">
					<feFlood  style="flood-color:white;flood-opacity:1" result="back"/>
					<feBlend  in="SourceGraphic" in2="back" mode="normal"/>
				</filter>
			</defs>
			
				<mask maskUnits="userSpaceOnUse" x="923.2" y="639.9" width="27.1" height="35.7" id="SVGID_00000119077933816074769830000017480442875640206266_">
				<g style="filter:url(#Adobe_OpacityMaskFilter_00000124123104642204062600000004383802563361104298_);">
				</g>
			</mask>
			
				<linearGradient id="SVGID_00000068646601960419853400000003508093917618344842_" gradientUnits="userSpaceOnUse" x1="936.7665" y1="640.8553" x2="936.7665" y2="681.9354">
				<stop  offset="0" style="stop-color:#FFFFFF"/>
				<stop  offset="1" style="stop-color:#000000"/>
			</linearGradient>
			
				<path style="mask:url(#SVGID_00000119077933816074769830000017480442875640206266_);fill:url(#SVGID_00000068646601960419853400000003508093917618344842_);" d="
				M923.2,640.7c0,0,20.7,26.2,20.4,32.2c0,0,1,4,5.2,2.3c4.2-1.7,0.1-14.1-21.9-35.3L923.2,640.7z"/>
		</g>
	</mask>
	
		<linearGradient id="SVGID_00000012434763009979576620000014936042927333827976_" gradientUnits="userSpaceOnUse" x1="936.7665" y1="640.8553" x2="936.7665" y2="681.9354">
		<stop  offset="0" style="stop-color:#FFFFFF"/>
		<stop  offset="1" style="stop-color:#FFFFFF"/>
	</linearGradient>
	<path style="fill:url(#SVGID_00000012434763009979576620000014936042927333827976_);" d="M923.2,640.7c0,0,20.7,26.2,20.4,32.2
		c0,0,1,4,5.2,2.3c4.2-1.7,0.1-14.1-21.9-35.3L923.2,640.7z"/>
	<path class="st43" d="M886.3,640.1c0.4-0.5,17.9-1,27.1-2.4s16.1-1.2,16.5,0c0.4,1.2,0.6,3-1.3,3.1s-42.3,2.9-43.2,2
		C884.4,641.9,886.3,640.1,886.3,640.1z"/>
	<path class="st43" d="M886.3,636.9c0.4-0.5,17.9-1,27.1-2.4c9.1-1.4,16.1-1.2,16.5,0c0.4,1.2,0.6,3-1.3,3.1
		c-1.9,0.2-42.3,2.9-43.2,2C884.4,638.7,886.3,636.9,886.3,636.9z"/>
	<path class="st43" d="M916.6,641.5c0,0,15.8,29,14.5,34.9c0,0,0.3,4.1,4.7,3.1s2.6-13.9-15.4-38.2L916.6,641.5z"/>
	<path class="st43" d="M923.2,640.7c0,0,20.7,26.2,20.4,32.2c0,0,1,4,5.2,2.3c4.2-1.7,0.1-14.1-21.9-35.3L923.2,640.7z"/>
	<path class="st9" d="M931.9,729.6c0-8.8-5.1-13.4-12.3-16.4l-8.2-3.4c-5-2.1-9.7-3.8-9.7-8.6c0-4.4,3.8-7.1,9.5-7.1
		c5.2,0,9.3,1.9,13.2,5.2l5.5-6.9c-3.8-3.9-9-6.5-14.6-7.4v-7.2h-8.9v7.2c-9.4,1.7-15.8,8.4-15.8,16.8c0,8.9,6.3,13.6,12.3,16.1
		l8.3,3.6c5.5,2.3,9.5,3.9,9.5,9c0,4.7-3.8,7.9-10.6,7.9c-5.7,0-11.5-2.8-15.9-6.9l-6.3,7.4c5,4.9,11.5,8,18.5,8.7v9.1h8.9v-9.4
		C925.8,745.3,931.9,738,931.9,729.6z"/>
	<path class="st60" d="M931.9,729.6c0-8.8-5.1-13.4-12.3-16.4l-8.2-3.4c-5-2.1-9.7-3.8-9.7-8.6c0-4.4,3.8-7.1,9.5-7.1
		c5.2,0,9.3,1.9,13.2,5.2l5.5-6.9c-3.8-3.9-9-6.5-14.6-7.4v-7.2h-8.9v7.2c-9.4,1.7-15.8,8.4-15.8,16.8c0,8.9,6.3,13.6,12.3,16.1
		l8.3,3.6c5.5,2.3,9.5,3.9,9.5,9c0,4.7-3.8,7.9-10.6,7.9c-5.7,0-11.5-2.8-15.9-6.9l-6.3,7.4c5,4.9,11.5,8,18.5,8.7v9.1h8.9v-9.4
		C925.8,745.3,931.9,738,931.9,729.6z"/>
	<path class="st43" d="M931.9,729.6c0-8.8-5.1-13.4-12.3-16.4l-8.2-3.4c-5-2.1-9.7-3.8-9.7-8.6c0-4.4,3.8-7.1,9.5-7.1
		c5.2,0,9.3,1.9,13.2,5.2l5.5-6.9c-3.8-3.9-9-6.5-14.6-7.4v-7.2h-8.9v7.2c-9.4,1.7-15.8,8.4-15.8,16.8c0,8.9,6.3,13.6,12.3,16.1
		l8.3,3.6c5.5,2.3,9.5,3.9,9.5,9c0,4.7-3.8,7.9-10.6,7.9c-5.7,0-11.5-2.8-15.9-6.9l-6.3,7.4c5,4.9,11.5,8,18.5,8.7v9.1h8.9v-9.4
		C925.8,745.3,931.9,738,931.9,729.6z"/>
	<polygon class="st9" points="975.3,669.4 970.9,669.4 970.9,665 969.5,665 969.5,669.4 965.1,669.4 965.1,670.8 969.5,670.8 
		969.5,675.2 970.9,675.2 970.9,670.8 975.3,670.8 	"/>
	<polygon class="st9" points="1051.6,713.4 1047.2,713.4 1047.2,709.1 1045.8,709.1 1045.8,713.4 1041.5,713.4 1041.5,714.9 
		1045.8,714.9 1045.8,719.2 1047.2,719.2 1047.2,714.9 1051.6,714.9 	"/>
	<polygon class="st9" points="754.4,750.4 750.4,750.4 750.4,746.3 749,746.3 749,750.4 745,750.4 745,751.7 749,751.7 749,755.7 
		750.4,755.7 750.4,751.7 754.4,751.7 	"/>
	<polygon class="st9" points="1088.7,706.2 1081.7,699.2 1078.6,696.2 1075.5,699.2 1068.5,706.2 1071.6,709.3 1077.1,703.8 
		1077.1,786.7 1080.1,786.7 1080.1,703.8 1085.6,709.3 	"/>
	<g>
		<g>
			
				<linearGradient id="SVGID_00000098940320201541723460000009414410694103516049_" gradientUnits="userSpaceOnUse" x1="942.0021" y1="771.3126" x2="942.0021" y2="791.5294">
				<stop  offset="0" style="stop-color:#FFFFFF"/>
				<stop  offset="1" style="stop-color:#FFFFFF"/>
			</linearGradient>
			<path style="fill:url(#SVGID_00000098940320201541723460000009414410694103516049_);" d="M960.3,770.9c-2.4,2.5-5.5,5.3-9.4,7.9
				c-10.5,6.9-21.2,8.3-27.1,8.6"/>
		</g>
	</g>
	<path class="st60" d="M872.6,617.3c0,0,1.8-11.7,6.5-10c4.7,1.8,8.7,4.2,12.3,5.9c3.6,1.7,23.2-2.4,24.2-2.8
		c1-0.4,8.8,23.1,4.4,29.4s6.9-0.6,7.7,0.2c0.8,0.8,6.3-28.4,6.3-28.4s2.1-10.2,1.9-11.7c-0.1-1.5-1.9-8-1.9-8l-8.1,4.7
		c0,0-11.6,4-12.5,4.2c-1,0.3-6.8,2.2-7.8,0.1c-1-2.1-2.9-7.7-3.6-8.1c-0.6-0.4-1.7-0.1-3.8-0.9c-2.1-0.8-9.3,7.1-9.8,7.9
		c-0.6,0.7-2.1,1.8-2.1,1.8l-6.9-1.5l-4.3-2.1l-6.2,8.6L872.6,617.3z"/>
	<path class="st62" d="M882.6,645.7c0,0-21.7,39.6-23.6,49.6c-1.9,10.1-5.3,22.6-2.8,30.3c2.5,7.6,9,22.2,12.7,29
		c3.7,6.8,31.8,21.6,35.9,23.1c4.1,1.5,14.5,4.1,23.7,4.7c9.3,0.6,29.4-8.9,29.4-8.9l-20,13.3l-21.2,1.6l-32.5-2.2l-25.4-12.3
		l-12.9-18.4l-6.8-25.5l3.6-25.2l14.6-27.1L882.6,645.7z"/>
	<path class="st60" d="M918,641.3c0,0,4,7.2,5.8,8.9c1.8,1.7,4.2,6.6,4.2,6.6l4.6,11.6l1.5,5.1c0,0-2.1,3.9-1,5
		c1.1,1.1,2.8,0.9,2.8,0.9l2-3.1l-1-7.8c0,0-10.4-18.7-10.7-19.3c-0.3-0.7-5.7-9-5.7-9L918,641.3z"/>
	<path class="st60" d="M925.4,640.7c0,0,5,6.5,7,7.9s5.1,6,5.1,6l6.2,10.8l2.3,4.8c0,0-1.5,4.1-0.2,5.1c1.3,0.9,2.9,0.5,2.9,0.5
		l1.5-3.3L948,665c0,0-13-16.9-13.5-17.5s-7-8-7-8L925.4,640.7z"/>
	<path class="st62" d="M877.3,654.2c0.8-0.3,8.4-6.4,9.8-6.8s11.3-2.3,11.3-2.3l15-0.1l6.4,0.6l-3.2-4.9l-31.2,2.1L872,657.2
		L877.3,654.2z"/>
	<path class="st60" d="M942.3,779.5l9.6-13.1l-4-17.6c0,0,8.4-25.8,8.4-26.3s-9.4-33.2-9.4-33.2s-0.1-3.5-1.2-6.8
		s-9.9-16.3-9.9-16.3l-13.8-24.9l1.1-0.6l15,20.8l5.9,12.5l2.9,1.6l3.3-0.4L948,665l-6.2-10.3l18.1,24.7l13.1,30.6l2.3,10.3
		l-2.1,25.3l-8.1,19.8L947,781.1l-12.2,3.8L942.3,779.5z"/>
	<path class="st60" d="M867.7,674.3c0,0,17.1-20.2,18.5-20.4c1.3-0.1,27-1.2,27-1.2l4.8-11.4c0,0-28.5,4.8-29.8,4.3
		c-1.3-0.5-9.3,6.9-9.3,6.9L867.7,674.3z"/>
	<path class="st60" d="M875.3,762.9c-0.8,0.1-16.7-27.3-16.7-27.3l-2.2-23.3l12.4-40.3l17.3-18.1l-14.8,37.2l4.9,34.5l7.9,31
		L875.3,762.9z"/>
	<path class="st60" d="M872.4,582.6l-8.8,23.2l12.3,30.5l-4.6,22l16.2-21.6l-17.8-25.9l-0.8-5.6l3.7-5.6c0,0,8.4,0.8,9,1
		c0.6,0.2,3.6-0.6,3.6-0.6L872.4,582.6z"/>
	<polygon class="st62" points="853.9,766.1 874.6,767.6 903.7,783.4 935.7,777.6 949.6,779.2 923.2,788.3 872.5,782.7 	"/>
	<polygon class="st62" points="935,610.5 939.9,628.3 939.9,652.2 927.2,636.7 	"/>
	<polygon class="st62" points="885,638.4 888.3,638.8 901.3,637.6 919.3,635.5 924,635.2 926.9,635.2 928.9,636.1 929.5,637 
		921.1,636.7 902.4,638.9 885.4,639.6 	"/>
	<path class="st62" d="M885.3,642.8l-0.2-0.8l1.7,0.1l11.6-0.8l11.5-0.5l8.1-0.9l5.9-0.5h6.2c0,0-0.2,0.9-0.4,0.9s-1.5,0.8-1.5,0.8
		l-41.9,1.9L885.3,642.8z"/>
	<path class="st62" d="M871,612.8c0.1,0.7,9.1,5.1,9.1,5.1l6.1,11.4l9,6.9l-9,1.3l-13.6-19.3L871,612.8z"/>
	<path class="st60" d="M951.8,670.1l-0.9,24.6c0,0,19.4,8.6,19.2,8.2S951.8,670.1,951.8,670.1z"/>
	<polygon class="st60" points="956.4,722.5 947,765.6 925.4,754.6 	"/>
	<path class="st60" d="M970.2,705.6c0,0.9-13.4,17.9-13.8,18.3c-0.4,0.4,12.9,31.5,12.9,31.5l6.1-32.9L970.2,705.6z"/>
	<path class="st60" d="M815.7,701.8l-9.5,30.4c0,0,13.4,11.3,15.3,11.8C823.3,744.5,815.7,701.8,815.7,701.8z"/>
	<polygon class="st60" points="799.1,756.6 793.2,770.9 815.6,777.6 	"/>
	<polygon class="st60" points="872.6,599.7 875.5,603.1 884.5,602.5 874.9,597.3 	"/>
	<path class="st60" d="M890.7,597.3l6.4-1.5c0,0,5.9,7,6.2,7.3c0.3,0.3,6.4,1.2,6.4,1.2l-5.7-4.9c0,0-2.2-6.1-3.2-6.5
		c-1-0.4-5.7-0.2-5.7-0.2L890.7,597.3z"/>
	<path class="st60" d="M918,601.9c0,0,5.7-3.6,7.5-3.4c1.8,0.2,5.9,0.5,6.3,1.7c0.4,1.3-2.3,18.2-2.3,18.2l0.6,14.1l5.8-23.7
		l-0.8-12.6l-4.2-3.4L918,601.9z"/>
</g>
<g>
	
		<radialGradient id="SVGID_00000170969223825746712700000007433258762100992418_" cx="349.6" cy="384.4999" r="92.8878" gradientUnits="userSpaceOnUse">
		<stop  offset="0" style="stop-color:#424242"/>
		<stop  offset="1" style="stop-color:#181818"/>
	</radialGradient>
	<path style="fill:url(#SVGID_00000170969223825746712700000007433258762100992418_);" d="M434.6,351.7l-51.6-0.3l0.3-51.6
		c0-4.4-3.5-8-7.9-8l-50.4-0.3c-4.4,0-8,3.5-8,7.9l-0.3,51.6l-51.6-0.3c-4.4,0-8,3.5-8,7.9l-0.3,50.4c0,4.4,3.5,8,7.9,8l51.6,0.3
		l-0.3,51.6c0,4.4,3.5,8,7.9,8l50.4,0.3c4.4,0,8-3.5,8-7.9l0.3-51.6l51.6,0.3c4.4,0,8-3.5,8-7.9l0.3-50.4
		C442.5,355.4,439,351.8,434.6,351.7z"/>
	
		<radialGradient id="SVGID_00000069357207811721683020000004980440922950591659_" cx="349.5999" cy="384.4999" r="44.3633" gradientUnits="userSpaceOnUse">
		<stop  offset="0" style="stop-color:#424242"/>
		<stop  offset="1" style="stop-color:#181818"/>
	</radialGradient>
	<path style="fill:url(#SVGID_00000069357207811721683020000004980440922950591659_);" d="M390.2,368.9l-24.7-0.1l0.1-24.7
		c0-2.1-1.7-3.8-3.8-3.8l-24.1-0.1c-2.1,0-3.8,1.7-3.8,3.8l-0.1,24.7l-24.7-0.1c-2.1,0-3.8,1.7-3.8,3.8l-0.1,24.1
		c0,2.1,1.7,3.8,3.8,3.8l24.7,0.1l-0.1,24.7c0,2.1,1.7,3.8,3.8,3.8l24.1,0.1c2.1,0,3.8-1.7,3.8-3.8l0.1-24.7l24.7,0.1
		c2.1,0,3.8-1.7,3.8-3.8l0.1-24.1C394,370.6,392.3,368.9,390.2,368.9z"/>
	
		<radialGradient id="SVGID_00000121260396925583308940000010289638402649276092_" cx="349.6" cy="384.5" r="92.8878" gradientUnits="userSpaceOnUse">
		<stop  offset="0" style="stop-color:#424242"/>
		<stop  offset="1" style="stop-color:#181818"/>
	</radialGradient>
	<path style="fill:url(#SVGID_00000121260396925583308940000010289638402649276092_);" d="M324.8,291.6l0,2l50.4,0.3
		c3.3,0,6,2.7,5.9,6l-0.3,51.6l0,2l2,0l51.6,0.3c1.6,0,3.1,0.6,4.2,1.8s1.7,2.6,1.7,4.2l-0.3,50.4c0,3.3-2.7,5.9-6,5.9l-51.6-0.3
		l-2,0l0,2l-0.3,51.6c0,3.3-2.7,5.9-6,5.9l-50.4-0.3c-1.6,0-3.1-0.6-4.2-1.8c-1.1-1.1-1.7-2.6-1.7-4.2l0.3-51.6l0-2l-2,0l-51.6-0.3
		c-1.6,0-3.1-0.6-4.2-1.8c-1.1-1.1-1.7-2.6-1.7-4.2l0.3-50.4c0-3.3,2.7-5.9,6-5.9l51.6,0.3l2,0l0-2l0.3-51.6c0-3.3,2.7-5.9,6-5.9
		V291.6 M324.8,291.6c-4.4,0-7.9,3.5-8,7.9l-0.3,51.6l-51.6-0.3c0,0,0,0,0,0c-4.4,0-7.9,3.5-8,7.9l-0.3,50.4c0,4.4,3.5,8,7.9,8
		l51.6,0.3l-0.3,51.6c0,4.4,3.5,8,7.9,8l50.4,0.3c0,0,0,0,0,0c4.4,0,7.9-3.5,8-7.9l0.3-51.6l51.6,0.3c0,0,0,0,0,0
		c4.4,0,7.9-3.5,8-7.9l0.3-50.4c0-4.4-3.5-8-7.9-8l-51.6-0.3l0.3-51.6c0-4.4-3.5-8-7.9-8L324.8,291.6
		C324.8,291.6,324.8,291.6,324.8,291.6L324.8,291.6z"/>
	<path class="st9" d="M293.3,410.4C293.3,410.4,293.3,410.4,293.3,410.4l-24.6-0.1c-1.3,0-2.6-0.5-3.5-1.5c-0.9-0.9-1.4-2.2-1.4-3.5
		l0.1-15c0-0.6,0.5-0.9,1-1c0.5,0,1,0.5,1,1l-0.1,15c0,0.8,0.3,1.5,0.9,2.1c0.6,0.6,1.3,0.9,2.1,0.9l24.6,0.1c0.5,0,1,0.5,1,1
		C294.3,410,293.8,410.4,293.3,410.4z"/>
	<path class="st9" d="M370.4,470.4C370.4,470.4,370.4,470.4,370.4,470.4l-26-0.1c-0.5,0-1-0.5-1-1c0-0.5,0.4-1,1-1c0,0,0,0,0,0
		l26,0.1c0,0,0,0,0,0c0.8,0,1.5-0.3,2.1-0.9c0.6-0.6,0.9-1.3,0.9-2.1l0.1-15.9c0-0.5,0.4-1,1-1c0,0,0,0,0,0c0.5,0,1,0.5,1,1
		l-0.1,15.9c0,1.3-0.5,2.6-1.5,3.5C373,469.9,371.7,470.4,370.4,470.4z"/>
	<path class="st9" d="M434.5,373.6C434.5,373.6,434.5,373.6,434.5,373.6c-0.6,0-1-0.5-1-1l0-8.9c0-1.6-1.3-3-3-3l-20.6-0.1
		c-0.5,0-1-0.5-1-1c0-0.6,0.5-1,1-1l20.6,0.1c2.7,0,5,2.3,5,5l0,8.9C435.5,373.1,435,373.6,434.5,373.6z"/>
	<path class="st9" d="M324.7,314.4C324.7,314.4,324.7,314.4,324.7,314.4c-0.6,0-1-0.5-1-1l0.1-9.8c0-1.3,0.5-2.6,1.5-3.5
		c0.9-0.9,2.2-1.4,3.5-1.4c0,0,0,0,0,0l12,0.1c0.5,0,1,0.5,1,1c0,0.5-0.4,0.9-1,1l-12-0.1c0,0,0,0,0,0c-0.8,0-1.5,0.3-2.1,0.9
		c-0.6,0.6-0.9,1.3-0.9,2.1l-0.1,9.8C325.7,313.9,325.3,314.4,324.7,314.4z"/>
</g>
</svg>

                  <div class="concept__block concept__left-card">
                    <div class="concept-card">
                      <h4 class="concept-card__title">M Health</h4>
                      <p class="concept-card__text">The future of Wellness. develop “AI Personal wellness” on the basis of the concept “eSelfcare” for health maintenance of people around the world. </p>
                    </div>
                  </div>
                  <div class="concept__block concept__right-card">
                    <div class="concept-card">
                      <h4 class="concept-card__title">Crypto</h4>
                      <p class="concept-card__text">The future of Internet. We will provide “Aging Well Concept” which is self-maintenance of own health by oneself to the whole world.</p>
                    </div>
                  </div>
                </div>  
              </div> 
            </div>
        </div>
        <div class="slide" id="slide-3">
          <div class="container data">
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box_wrap"1;">
                  <div class="token-item__icon">
                    <div class="token-item__round">
                    <img src="<?php echo base_url() ?>assets/images/tools.png" alt="tools" class="token-item__img">
                    </div>
                  </div>

                  <h4>Secure Wallet</h4>
                  <p>kubitcoin&nbsp; is received, stored, and sent using Decentralized&nbsp; Wallet which is under your control</p>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box_wrap"1;">
                    <div class="token-item__icon">
                      <div class="token-item__round">
                      <img src="<?php echo base_url() ?>assets/images/books.png" alt="tools" class="token-item__img">
                      </div>
                    </div>
                      <h4>Wearables</h4>
                      <p>Wearables keeps individuals engaged and monitor aspects of health like activity level heart rate and sleep quality</p>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box_wrap"1;">
                      <div class="token-item__icon">
                        <div class="token-item__round">
                        <img src="<?php echo base_url() ?>assets/images/gift.png" alt="tools" class="token-item__img">
                        </div>
                      </div>
                      <h4> Wellness Planning</h4>
                      <p>Each user has unique needs, proper health and wellness planning as per requirement of the body.</p>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box_wrap"1;">
                      <div class="token-item__icon">
                        <div class="token-item__round">
                        <img src="<?php echo base_url() ?>assets/images/fire.png" alt="tools" class="token-item__img">
                        </div>
                      </div>
                      <h4>Personal Coach</h4>
                      <p>Better understanding with personalized approach for individuals<span style="font-size: 0.875rem;">&nbsp; &nbsp; &nbsp;</span></p>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box_wrap">
                      <div class="token-item__icon">
                        <div class="token-item__round">
                        <img src="<?php echo base_url() ?>assets/images/pen.png" alt="tools" class="token-item__img">
                        </div>
                      </div>
                      <h4>Gaming and Learning</h4>
                      <p>Play and learn about Nutrition and wellness all age groups.</p>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box_wrap"1;">
                      <div class="token-item__icon">
                        <div class="token-item__round">
                        <img src="<?php echo base_url() ?>assets/images/profile.png" alt="tools" class="token-item__img">
                        </div>
                      </div>
                      <h4>Incentivising</h4>
                      <p>Earn rewards in kubitcoin token for all users at different levels</p>
                  </div>
              </div>
                      
            </div>
          </div>
        </div>
        <div class="slide" id="slide-4">
            <div class="container data">
                <div class="row w-100 align-items-center">
                    <div class="col-lg-6 col-12">
                        <h3 class="title colored-text">	                         
                          Token Distribution
                        </h3>
                        <table class="token_table">
                          <thead>
                            <tr>
                              <th>Distribution:</th>
                              <th>Token</th>
                              <th>%</th>
                            </tr>
                          </thead>
                               
                          <tbody>
                            <tr>
                              <td>Web 3 Wellness App users :</td>
                              <td>18000000</td>
                                <td>30%</td>
                            </tr>
                            <tr>
                              <td>Airdrop and bounty :</td>
                              <td>6000000</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                              <td>kubitcoin Minting:</td>
                              <td>12000000</td>
                                <td>15%</td>
                            </tr>
                            <tr>
                              <td>Reserve fund :</td>
                              <td>3000000</td>
                                <td>5%</td>
                            </tr>
                            <tr>
                                <td>Development of dapps :</td>
                              <td>3000000</td>
                                <td>5%</td>
                            </tr>
                            <tr>
                                <td>Team :</td>
                              <td>6000000</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                              <td>Advisors :</td>
                              <td>3000000</td>
                                <td>5%</td>
                            </tr>
                            <tr>
                              <td>Marketing,staking and trading rewards :</td>
                            <td>12000000</td>
                                <td>20%</td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                      <img class="panel_img" src="<?php echo base_url() ?>assets/images/business_model.png" />
                    </div>
                </div>
            </div>
        </div>
        <div class="slide" id="slide-5">
            <div class="container data">
              <ul class="advantage__list">
                <li class="advantage__item advantage__item_first">
                  <div class="bg-item advantage__puzzle">
                    <div class="advantage__icon"><img src="<?php echo base_url() ?>assets/images/puzzle-break.svg" alt="break-puzzle"></div>
                  </div>
                  <div class="bg-item advantage__content">
                    <div class="bg-item advantage__puzzle advantage__puzzle_mobile">
                      <div class="advantage__icon"><img src="<?php echo base_url() ?>assets/images/puzzle-break.svg" alt="break-puzzle"></div>
                    </div>
                    <h3 class="advantage-content__title">2021</h3>
                    <h4 class="advantage-content__subtitle">Start</h4>
                    <p class="advantage-content__text">
                      Launch of Token
                    </p>
                  </div>
                </li>
                <li class="advantage__item advantage__item_second">
                  <div class="bg-item advantage__puzzle">
                    <div class="advantage__icon"><img src="<?php echo base_url() ?>assets/images/puzzle.svg" alt="break-puzzle"></div>
                  </div>
                  <div class="bg-item advantage__content">
                    <div class="bg-item advantage__puzzle advantage__puzzle_mobile">
                      <div class="advantage__icon"><img src="<?php echo base_url() ?>assets/images/puzzle.svg" alt="break-puzzle"></div>
                    </div>
                    <h3 class="advantage-content__title">2022</h3>
                    <h4 class="advantage-content__subtitle">Wellness App Launch</h4>
                    <p class="advantage-content__text">
                      Normal wellness app Launch
                      kubitcoin explorer launch
                      Airdrop round 2
                      Community engagement
                      Heckathons and fests 
                    </p>
                  </div>
                </li>
                <li class="advantage__item advantage__item_second">
                  <div class="bg-item advantage__puzzle">
                    <div class="advantage__icon"><img src="<?php echo base_url() ?>assets/images/puzzle.svg" alt="break-puzzle"></div>
                  </div>
                  <div class="bg-item advantage__content">
                    <div class="bg-item advantage__puzzle advantage__puzzle_mobile">
                      <div class="advantage__icon"><img src="<?php echo base_url() ?>assets/images/puzzle.svg" alt="break-puzzle"></div>
                    </div>
                    <h3 class="advantage-content__title">2023</h3>
                    <h4 class="advantage-content__subtitle">Web Wallet</h4>
                    <p class="advantage-content__text">
                      
                      kubitcoin DAO governanace
                      Release kubitcoin of web wallet
                      South east asia launch
                      Wazirx, Airdrop round 3
                      latin america and africa launch

                    </p>
                  </div>
                </li>
              </ul>
              
            </div><!--container-->
        </div>

        <div class="slide" id="slide-6">
            <div class="container data">
              <div class="row  w-100">
                <div class="col-lg-4 col-12">
                  <p class="headTitle">Invest with us</p>
                  <h3 class="title colored-text">Frequently Asked Questions</h3>
                  <div class="subparagraph">
                      <p>Frequently asked questions (FAQ) or Questions and Answers (Q&A), are listed questions and answers, all supposed to be commonly asked in some context</p>
                  </div>
                </div>
                <div class="col-lg-8 col-12">
                  <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          What is cryptocurrency?
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          A digital currency in which transactions are verified and records maintained by a decentralized system using cryptography, rather than by a centralized authority.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          What is Blockchain?
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          A blockchain is a distributed database that is shared among the nodes of a computer network. As a database, a blockchain stores information electronically in digital format. Blockchains are best known for their crucial role in cryptocurrency systems, such as Bitcoin, kubitcoin for maintaining a secure and decentralized record of transactions.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          what is Decentralization?
                        </button>
                      </h2>
                      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          Decentralization or decentralisation is the process by which the activities of an organization, particularly those regarding planning and decision making, are distributed or delegated away from a central, authoritative location or group.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="heading4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                          what is IDO in cryptocurrency
                        </button>
                      </h2>
                      <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          An initial DEX offering, or IDO, is a new and exciting type of decentralized and permissionless crowdfunding platform, which is opening up a new way of fundraising in the crypto space. If a project is launching an IDO, it means the project is launching a coin or token via a decentralized liquidity exchange. This is a type of crypto asset exchange that depends on liquidity pools where traders can swap tokens, including crypto coins and stablecoins.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="heading5">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                          What is staking in kubitcoin ?
                        </button>
                      </h2>
                      <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          Cryptocurrency staking involves earning rewards for holding a particular crypto asset for a period of time. You earn rewards in kubitcoin for holding your kubitcoin for particular period of time.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
        </div>

        <div class="slide" id="slide-7">
            <div class="container data">
                <div class="row justify-content-between align-items-center w-100">
                    <div class="col-lg-5 col-12">
                        <h3 class="title colored-text">Contact Us</h3>
                        <div class="subparagraph">
                            <h5 class="subtitle">kubitcoin@gmail.com </h5>             
                            <div class="Social-media">
                                <a href="#"><font color="#007cc4"><i class="fab fa-facebook"></i></font></a>
                                <a href="#"><font color="#007cc4"><i class="fab fa-twitter"></i></font></a>
                                <a href="#"><font color="#007cc4"><i class="fab fa-instagram"></i></font></a>
                                <a href="#"><font color="#007cc4"><i class="fab fa-telegram"></i></a></font>
                                <a href="#"><font color="#007cc4"><i class="fab fa-linkedin"></i></a></font>
                            </div>          
                        </div>
                    </div>
                    <div class="col-lg-7 col-12">
                      <form>
                        <input class="form-control" type="text" placeholder="Name" />
                        <input class="form-control" type="email" placeholder="Email" />
                        <input class="form-control" type="text" placeholder="Subject" />
                        <textarea class="form-control" rows="7" placeholder="Message"></textarea>
                        <button type="submit" class="btn linear-btn">Submit</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'footer.php';?>
    

   