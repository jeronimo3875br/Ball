<!D0CTYPE HTML>

<html lang="pt-br">
	
	<head>
		<title>Ball</title>
		<meta charset="utf-8"/>
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0"
		/>
	</head>
	
	<body>
		<canvas id="content"></canvas>
	</body>
	
	<script>
		
		const ctx = document.querySelector("#content");
		const stage = ctx.getContext("2d");
		
		ctx.width = window.innerWidth;
		ctx.height = window.innerHeight;
		
		const balls = [];
		
		const colors = [
			"#FF0000", "#FF00B0", "#00A0FF", "#FCFF00", 
			"#053AFF","#00FFA0", "#7D09FF", "#0ff000"
		];
		
		function random(value){
			return Math.floor(Math.random() * value);
		};
		
		function Ball(px, py, sz, dx, dy, gvt, ft, cl){
			
			this.px = px;
			this.py = py;
			
			this.radius = sz;
			
			this.dx = dx;
			this.dy = dy;
			
			this.gravity = gvt;
			this.friction = ft;
			
			this.color = cl;
			
			this.createObject = function(){
				
				stage.beginPath();
				stage.lineWidth = 4;
				stage.strokeStyle = "#ffffff";
				stage.fillStyle = this.color;
				stage.arc(this.px, this.py, this.radius, 0, Math.PI * 2);
				stage.stroke();
				stage.fill();
				
			};
			
			this.update = function(){
				
				if (this.py + this.radius + this.dy >= ctx.height){
					this.dy = -this.dy;
					this.dy = this.dy * this.friction;
				}else{
					this.dy += this.gravity;
				};
				
				if (this.px + this.radius >= ctx.width || this.px - this.radius <= 0){
					this.dx = -this.dx * this.friction;
				};
				
				this.py += this.dy;
				this.px += this.dx;
				
				this.createObject();
			};
			
		};
		
		function Animate(){
			window.requestAnimationFrame(Animate);
			
			stage.clearRect(0, 0, ctx.width, ctx.height);
			
			for (let i = 0; i < balls.length; i++){
				balls[i].update();
			};
			
		};
		
		Animate();
		
		window.addEventListener("resize", () => {
			ctx.width = window.innerWidth;
			ctx.height = window.innerHeight;
		});
		
		window.addEventListener("click", (event) => {
			
			var px = event.clientX;
			var py = event.clientY;
			
			var sz = 30;
			
			var dx = 5;
			var dy = 10;
			
			var gvt = 0.8;
			
			var ft = 0.8;
			
			var cl = colors[random(colors.length)];
			
			balls.push(new Ball(px, py, sz, dx, dy, gvt, ft, cl));
			
		});
	
		
	</script>
	
	<style>
		* { 
			margin: 0px; padding: 0px;
		}
		
		body { 
			background-color: #212121;
	 }
	</style>
	
</html>
