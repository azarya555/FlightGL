<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="chrome=1"/>
		<title>FlightGL - Experience a Flight Right in Your Browser</title>
		<style>
			body {
				background-color:#000000;
				background-image:-webkit-gradient(radial, circle, from(#ffffff), to(#000000));
				background-image:-webkit-radial-gradient(circle, #ffffff, #000000);
				background-image:-moz-radial-gradient(circle, #ffffff, #000000);
				background-image:-ms-radial-gradient(circle, #ffffff, #000000);
				background-image:-o-radial-gradient(circle, #ffffff, #000000);
				background-image:radial-gradient(circle, #ffffff, #000000);
				color:#222222;
				text-align: center;
			}
			
			h1 {
				text-shadow:0 0 3px #ffffff;
			}
		</style>
	</head>
	<body>
		<h1><font face="fantasy">FlightGL</font></h1>
<hr width="100%" size="5"/>
		<script src="js/RequestAnimationFrame.js"></script>
		<script src="js/Three.js"></script>
		<script type="text/javascript">
			init();
			
			function init() {
			var cw = window.innerWidth,
				ch = window.innerHeight/1.35;
				
			var prx = 0, pry = 0, prz = 0;
			var pz = 0, cz = 0;
				
			var angle = 45,
				asp = cw/ch,
				near = 0.01,
				far = 100000;
			
			var cont = document.body;

			var renderer = new THREE.WebGLRenderer( { antialias: true } );
			var camera = new THREE.Camera( angle, asp, near, far );
			var scene = new THREE.Scene();
			
			camera.position.y = 2.5;
			camera.position.z = 100;
			
			renderer.setSize( cw, ch );
			
			var loader = new THREE.JSONLoader( true ),
				apnmodel = 'airplane/Typhoon_X1.js',
				trrnmodel = 'terrain/sandway.js';
				loader.load( { model: apnmodel, callback: apn } );
				loader.load( { model: trrnmodel, callback: trrn } );
			
			var l = new THREE.PointLight( 0xFFFFFF );
				l.position.x = 0;
				l.position.y = 100;
				l.position.z = 150;
			scene.addLight( l );
			
			cont.appendChild( renderer.domElement );
			
			function trrn( geometry ) {
				var mat = [ new THREE.MeshFaceMaterial(), new THREE.MeshLambertMaterial( { color: 0x442005, shading:THREE.FlatShading} ) ];
				
				terrain = new THREE.Mesh( geometry, mat );
				terrain.scale.x = 100;
				terrain.scale.y = 10;
				terrain.scale.z = 100;
				scene.addObject( terrain );
			}
			
			function apn( geometry ) {
				var mat = [ new THREE.MeshFaceMaterial(), new THREE.MeshLambertMaterial( { color: 0xDDEEFF, opacity:0.9, shading:THREE.FlatShading } ) ];			

				airpln = new THREE.Mesh( geometry, mat );
				airpln.scale.x = 2;
				airpln.scale.y = 2.5;
				airpln.scale.z = 2.5;
				airpln.position.y = 2.5;
				scene.addObject( airpln );
			}
			
			window.addEventListener( 'keydown', function(){
				switch(event.keyCode){
					case 68:
						prz -= 0.025;
					break;
					case 65:
						prz += 0.025;
					break;
					case 87:
						prx -= 0.025;
					break;
					case 83:
						prx += 0.025;
					break;
					case 39:
						prz -= 0.025;
					break;
					case 37:
						prz += 0.025;
					break;
					case 38:
						prx -= 0.025;
					break;
					case 40:
						prx += 0.025;
					break;
				}
			}, false );
			
			animate();
			
			function animate() {
				requestAnimationFrame( animate );
				render();
			}

			function render() {
				airpln.rotation.x = prx;
				airpln.rotation.y = pry;
				airpln.rotation.z = prz;
				pz -= 0.8;
				cz = pz + 100;
				airpln.position.z = pz;
				camera.position.z = cz;
				renderer.render( scene, camera );
			}
			}
	</script>
	</body>
</html>