var lpb;
var peeBoyAnim;

$(document).ready(function()
{
	$('#preview').click(startAnimation);
	
	peeBoyAnim = new PeeBoyAnimation('#sprite-container');
});

function startAnimation()
{
	$('#content').toggle();
	$('canvas').toggle();
	peeText = $('#input_1').val();
	
	if(peeBoyAnim.loadedCount >= peeBoyAnim.totalSprites && !lpb)
	{
		peeBoyAnim.playTurnaroundAnimation();
	}
	else
	{
		peeBoyAnim.playWhenLoaded = true;
		$('#preloader').fadeIn();
	}
	
	return false;
}

function PeeBoyAnimation(spriteContainer)
{
	this.totalSprites = 2;
	this.loadedCount = 0;
	this.playWhenLoaded = false;
	this.currentIndex = 0;
	this.animationRow = 0;
	this.container = $(spriteContainer);
	this.animationType = -1;
	this.animationDirection = 0;
	this.spriteInterval;
	this.animSpeed = 70;
	
	// turn around loop
	this.idleFrames = 19;
	this.idleImg = new Image();
	this.idleImg.addEventListener("load", this.idleLoaded, false);
    this.idleImg.src = 'http://www.littlepeeboy.com/images/animations/idle_loop.png';
    
	// turn around loop
	this.turnaroundFrames = 20;
	this.turnaroundImg = new Image();
	this.turnaroundImg.addEventListener("load", this.imageLoaded, false);
    this.turnaroundImg.src = 'http://www.littlepeeboy.com/images/animations/turnaround1.png';
    
    this.turnaround2Frames = 27;
	this.turnaround2Img = new Image();
	this.turnaround2Img.addEventListener("load", this.imageLoaded, false);
    this.turnaround2Img.src = 'http://www.littlepeeboy.com/images/animations/turnaround2.png';
    
    // pee loop
	this.peeLoopFrames = 20;
	this.peeLoopImg = new Image();
	this.peeLoopImg.addEventListener("load", this.imageLoaded, false);
    this.peeLoopImg.src = 'http://www.littlepeeboy.com/images/animations/pee_loop.png';
}

PeeBoyAnimation.prototype.idleLoaded = function(event)
{
	if(peeBoyAnim.animationType == -1) peeBoyAnim.playIdleLoop();
}

PeeBoyAnimation.prototype.imageLoaded = function(event)
{
	peeBoyAnim.loadedCount++;
	
	if(peeBoyAnim.playWhenLoaded && peeBoyAnim.loadedCount >= peeBoyAnim.totalSprites)
	{
		peeBoyAnim.playTurnaroundAnimation();
		$('#preloader').fadeOut();
	}
}

PeeBoyAnimation.prototype.playIdleLoop = function()
{
	this.animationType = 0;
	this.currentIndex = 0;
	this.animationRow = 0;
	this.animationDirection = 0;
	
	this.container.css({'backgroundImage' : 'url('+this.idleImg.src+')', 'backgroundPosition' : '0px 0px' });
	
	var self = this;
	window.clearInterval(this.spriteInterval);
	this.spriteInterval = window.setInterval(function(){ self.animate(); }, this.animSpeed);
}

PeeBoyAnimation.prototype.playTurnaroundAnimation = function()
{
	this.animationType = 1;
	this.currentIndex = 0;
	this.animationRow = 0;
	this.animationDirection = 0;
	
	this.container.css({'backgroundImage' : 'url('+this.turnaroundImg.src+')', 'backgroundPosition' : '0px 0px' });
	
	var self = this;
	window.clearInterval(this.spriteInterval);
	this.spriteInterval = window.setInterval(function(){ self.animate(); }, this.animSpeed);
}

PeeBoyAnimation.prototype.playTurnaround2Animation = function()
{
	this.animationType = 1.5;
	this.currentIndex = 0;
	this.animationRow = 0;
	this.animationDirection = 0;
	
	this.container.css({'backgroundImage' : 'url('+this.turnaround2Img.src+')', 'backgroundPosition' : '0px 0px' });
	
	var self = this;
	window.clearInterval(this.spriteInterval);
	this.spriteInterval = window.setInterval(function(){ self.animate(); }, this.animSpeed);
}

PeeBoyAnimation.prototype.playPeeAnimation = function()
{
	this.animationType = 2;
	this.currentIndex = 0;
	this.animationRow = 0;
	this.animationDirection = 0;
	this.container.css({'backgroundImage' : 'url('+this.peeLoopImg.src+')', 'backgroundPosition' : '0px 0px' });
	
	var self = this;
	window.clearInterval(this.spriteInterval);
	this.spriteInterval = window.setInterval(function(){ self.animate(); }, this.animSpeed*.75);
}

PeeBoyAnimation.prototype.playEndAnimation = function()
{
	this.animationType = 3;
	this.currentIndex = this.turnaround2Frames;
	this.animationRow = 3;
	this.animationDirection = 1;
	
	var self = this;
	window.clearInterval(this.spriteInterval);
	this.spriteInterval = window.setInterval(function(){ self.animate(); }, this.animSpeed);
}

PeeBoyAnimation.prototype.playEnd2Animation = function()
{
	this.animationType = 3.5;
	this.currentIndex = this.turnaroundFrames;
	this.animationRow = 2;
	this.animationDirection = 1;
	
	var self = this;
	window.clearInterval(this.spriteInterval);
	this.spriteInterval = window.setInterval(function(){ self.animate(); }, this.animSpeed);
}

PeeBoyAnimation.prototype.stopAnimations = function()
{
	window.clearInterval(this.spriteInterval);
}

PeeBoyAnimation.prototype.animationComplete = function()
{
	if(this.animationType == 1) 
	{
		this.playTurnaround2Animation();
	}
	else if(this.animationType == 1.5) 
	{
		lpb = new LPB();
		this.playPeeAnimation();
	}
	else if(this.animationType == 3)
	{
		this.playEnd2Animation();
	}
	else if(this.animationType == 3.5)
	{
		this.stopAnimations();
	}
}

PeeBoyAnimation.prototype.animate = function()
{
	if(this.animationType == -1) return;
	
	var cols = 7;
	var xpos, totalFrames, reverse, frameheight;
	
	xpos = this.currentIndex % cols;
	
	switch(this.animationType)
	{
		case 0:
			reverse = 1;
			totalFrames = this.idleFrames;
			break;
		case 1:
			reverse = 0;
			totalFrames = this.turnaroundFrames;
			break;
		case 1.5:
			reverse = 0;
			totalFrames = this.turnaround2Frames;
			break;
		case 2:
			reverse = 1;
			totalFrames = this.peeLoopFrames;
			break;
		case 3:
			this.container.css({'backgroundImage' : 'url('+this.turnaround2Img.src+')'});
			reverse = 0;
			totalFrames = this.turnaround2Frames;
			break;
		case 3.5:
			this.container.css({'backgroundImage' : 'url('+this.turnaroundImg.src+')'});
			reverse = 0;
			totalFrames = this.turnaroundFrames;
			break;
	}
	
	this.container.css({'backgroundPosition' : (xpos * -288)+'px '+(-374 * this.animationRow)+'px'});
	
	if(this.animationDirection == 0)
	{
		if(this.currentIndex == totalFrames-1)
		{
			if(reverse == 1) 
			{
				this.animationDirection = 1;
				this.currentIndex--;
			}
			else
			{
				this.animationComplete();
			}
		}
		else
		{
			this.currentIndex++;
			if(xpos == cols-1) this.animationRow++;
		}
	}
	else if(this.animationDirection == 1)
	{
		if(this.currentIndex == 0)
		{
			if(reverse == 1) 
			{
				this.animationDirection = 0;
				this.currentIndex++;
			}
			else
			{
				this.animationComplete();
			}
		}
		else
		{
			this.currentIndex--;
			
			if(xpos == 0) this.animationRow--;
		}
	}	
}

function LPB()
{
	// Basic canvas objects and info
	this.canvas = $('#canvas');  
	this.ctx = $('#canvas')[0].getContext("2d");
	this.width = this.canvas.width();
	this.height = this.canvas.height();
	
	// Pixel data and drawing mechanics
	this.tp = this.ctx.createImageData(this.width, this.height);
	this.drawInterval;
	this.pdIndex = 1;
	this.sIndex = 1;
	this.tpp = new Array();
	this.startPos = {x: 400, y: 370};
	this.streamPos = {x:100, y:100};
	this.streamSpeed = 5;
	this.drawSpeed = 15;
	this.peeColor = "rgba(207, 190, 0, .8)";
	
	var platform = navigator.platform;
	
	if(platform.indexOf("android") > -1 || platform.indexOf("iPhone") > -1 || platform.indexOf('iPad') > -1 )
	{
	   this.drawSpeed = 30;
	}
	
	// Pee boy image
	this.emitter = new Emitter(this.startPos.x, this.startPos.y);
	
	// Draw img/text to be pee'd
	this.drawBaseText(peeText); 
    
	// Start drawing
	var self = this;
	this.drawInterval = window.setInterval(function(){ self.drawText(); }, 10);
}

LPB.prototype.drawBaseText = function(text)
{	
	this.ctx.font = "40pt Vornov";

	var words = text.split(/[\s]+/);
	var currentLine = "";
	var lines = [];
	var maxLength = 550;
	var fontHeight = 50;
	var xOffset = 0;
	
	for(var i = 0; i < words.length; i++)
	{
		fontHeight = (40+(i*10));
	
		if(this.ctx.measureText(currentLine+words[i]).width < maxLength)
		{
			currentLine += words[i];
			currentLine += " ";
		}
		else
		{
			
			lines.push(currentLine);
			currentLine = words[i]+" ";
		}
	}
	
	lines.push(currentLine); 
	
	// Grab image data
	
	for(var i = 0; i < lines.length; i++)
	{
		fontHeight = (40+(i*10));
	
		this.ctx.font = (fontHeight-5)+"pt Vornov";
	
		xOffset = (maxLength - this.ctx.measureText(lines[i]).width) * .5;

		var lastPos = 0;
		var targetX = 0;
		var dist = 0;
		var shear = .9;
		var spacing = 100;

		for(var c = 0; c < lines[i].length; c++)
		{
			targetX = this.startPos.x+xOffset+lastPos;
			
			dist = ((maxLength * .5) - Math.round((maxLength + this.startPos.x) - targetX)) / (maxLength * .5);
			dist -= .65;
			dist = dist.toFixed(4);
			
			this.ctx.save();
			this.ctx.transform(1, 0, dist*shear, 1, 0, 0);  
			
			this.ctx.fillStyle = "rgba(255, 255, 255, .2)";  
	    	this.ctx.fillText(lines[i].charAt(c), targetX-(dist * ((maxLength - spacing) * shear)), this.startPos.y+2+(i*fontHeight)); 
			
			this.ctx.fillStyle = "rgba(162, 148, 83, .1)";  		    
		    this.ctx.fillText(lines[i].charAt(c), targetX-(dist * ((maxLength - spacing) * shear)), this.startPos.y-3+(i*fontHeight));  
		    this.ctx.fillText(lines[i].charAt(c), targetX-(dist * ((maxLength - spacing) * shear)), this.startPos.y-2+(i*fontHeight));
		    this.ctx.fillText(lines[i].charAt(c), targetX-(dist * ((maxLength - spacing) * shear)), this.startPos.y-1+(i*fontHeight));
			
			this.ctx.fillStyle = this.peeColor;  
	    	this.ctx.fillText(lines[i].charAt(c), targetX-(dist * ((maxLength - spacing) * shear)), this.startPos.y+(i*fontHeight)); 
	    	
	    	lastPos += this.ctx.measureText(lines[i].charAt(c)).width;
	    	
	    	this.ctx.restore(); 
    	}
    	
    	
	    
	    this.imgd = this.ctx.getImageData(0, 0, this.width, this.height);
	    
	    // Find all non-transparent pixels and store them
		var pix = this.imgd.data;
	    var firstRow = -1;
	    var row = 0;
	    var count = 0;
	    var tempArr = new Array();
	    
	    
	    for (var d = 0, n = pix.length; d < n; d += 4)
	    {
	    	if(pix[d+3] > 0) 
	    	{
				if(firstRow == -1) firstRow = row;
	    		tempArr.push({index: d, x: count, y: row-firstRow});
	    	}
	    	
	    	count++;
	    	
	    	if(d % (this.width * 4) == 0)
	    	{
	    		row++;
	    		count = 0;
	    	}
		}
		
		tempArr = tempArr.slice(Math.max(0, this.tpp.length-1), tempArr.length);
		
		// sort by left to right, bottom to top
		tempArr.sort(compare);
		
		this.tpp = this.tpp.concat(tempArr);
    }
    
    this.ctx.clearRect(0, 0, 1000, 600);
}

LPB.prototype.drawText = function()
{	
	// If no more pixels, quit drawing
	if(this.pdIndex+this.drawSpeed >= this.tpp.length)
	{
		clearInterval(this.drawInterval);
		this.ctx.putImageData(this.tp, 0, 0);
		peeBoyAnim.stopAnimations();
		peeBoyAnim.playEndAnimation();
		return;
	}

	this.ctx.clearRect(0, 0, this.width, this.height);
	
	// Lewt the stream get ahead before starting to draw image/text
	if(this.sIndex > 1000)
	{
		for(var i = 0; i < this.drawSpeed; i++)
		{
			this.revealAtIndex(this.pdIndex+1);
			this.pdIndex++;
		}
		
		this.ctx.putImageData(this.tp, 0, 0);
	}
	
	// If the stream isn't at the end, draw the stream
	if(this.sIndex < this.tpp.length)
	{
		// Draw stream lines
		this.streamPos.x += (this.tpp[this.sIndex].x - this.streamPos.x) / (this.streamSpeed * 2);
		this.streamPos.y += (this.tpp[this.sIndex].y - this.streamPos.y) / (this.streamSpeed / 2);
		
		var offset = Math.random() * 5;
		this.ctx.beginPath();
		this.ctx.strokeStyle = this.peeColor;
		this.ctx.lineWidth = 2; 
		
		this.ctx.moveTo(225, 400+offset); 
		this.ctx.bezierCurveTo(250+offset, this.startPos.y-300, this.streamPos.x-100, this.startPos.y-200, this.streamPos.x, 340+this.streamPos.y);
		
		this.ctx.moveTo(225+2, 400+offset+2); 
		this.ctx.bezierCurveTo(250+offset, this.startPos.y-300, this.streamPos.x-100, this.startPos.y-200, this.streamPos.x+1, 340+this.streamPos.y+1);
		
		this.ctx.lineWidth = 1; 
		this.ctx.moveTo(225+3, 400+offset+3); 
		this.ctx.bezierCurveTo(250+offset, this.startPos.y-300, this.streamPos.x-100, this.startPos.y-200, this.streamPos.x, 340+this.streamPos.y);
		this.ctx.stroke();
		
		// Update and step emitter
		this.emitter.startX = this.streamPos.x;
		this.emitter.startY = 340+this.streamPos.y;
		if(this.sIndex % 4 == 0) this.emitter.createParticle();
		this.emitter.step();
		this.emitter.draw();
		
		this.sIndex += this.drawSpeed;
	}
}


LPB.prototype.revealAtIndex = function(index)
{
	// Draw Pixels at index
	var currentIndex = this.tpp[index].index;
	
	if(currentIndex)
	{
		this.tp.data[currentIndex] 		= this.imgd.data[currentIndex];
		this.tp.data[currentIndex+1] 	= this.imgd.data[currentIndex+1];
		this.tp.data[currentIndex+2] 	= this.imgd.data[currentIndex+2];
		this.tp.data[currentIndex+3] 	= this.imgd.data[currentIndex+3];
	}
	
	// Draw some random pixels further ahead than current index

	var ri = index + Math.round(Math.random() * 500);
	if(ri < this.tpp.length) var randIndex = this.tpp[ri].index;
	
	var ri2 = index + Math.round(Math.random() * 600);
	if(ri2 < this.tpp.length) var randIndex2 = this.tpp[ri2].index;
	
	if(randIndex)
	{
		this.tp.data[randIndex] 	= this.imgd.data[randIndex];
		this.tp.data[randIndex+1] 	= this.imgd.data[randIndex+1];
		this.tp.data[randIndex+2] 	= this.imgd.data[randIndex+2];
		this.tp.data[randIndex+3] 	= this.imgd.data[randIndex+3];
	}
	
	if(randIndex2)
	{
		this.tp.data[randIndex2] 	= this.imgd.data[randIndex2];
		this.tp.data[randIndex2+1] 	= this.imgd.data[randIndex2+1];
		this.tp.data[randIndex2+2] 	= this.imgd.data[randIndex2+2];
		this.tp.data[randIndex2+3] 	= this.imgd.data[randIndex2+3];
	}
}


function Emitter(startX, startY)
{
	// Base emitter
	this.startX = startX;
	this.startY = startY;
	this.color = "rgba(207, 190, 0, .8)";
	this.size = 3;
	this.gravity = .1;
	this.friction = .97;
	this.particles = new Array();
	this.maxParticles = 50;
	this.maxBlastParticles = 80;
	this.canvasContext =  $('#canvas')[0].getContext("2d");
}

Emitter.prototype.createParticle = function()
{
	// Creates a new particle if less than max, if not, reuse one
	if(this.particles.length > this.maxParticles)
	{
		this.particles[0].lifeSpan = 1;
		this.particles[0].velocityX = (Math.random() * 5) - 2;
		this.particles[0].velocityY = (Math.random() * 5) - 2;
		this.particles[0].x = this.startX;
		this.particles[0].y = this.startY;
		this.particles.push(this.particles.shift());
	}
	else
	{
		var particle = new Particle();
		particle.x = this.startX;
		particle.y = this.startY;
		particle.velocityX = (Math.random() * 5) - 2;
		particle.velocityY = (Math.random() * 5) - 2;
		
		this.particles.push(particle);
	}
}

Emitter.prototype.step = function()
{
	// Update all the particles
	for(i = 0; i < this.particles.length; i++)
	{			
		this.particles[i].x -= this.particles[i].velocityX;
		this.particles[i].y -= this.particles[i].velocityY;
		this.particles[i].velocityX *= this.friction;
		this.particles[i].velocityY *= this.friction;
		this.particles[i].velocityY -= this.gravity;
		this.particles[i].lifeSpan -= .03;	
		
		if(this.particles[i].lifeSpan < 0) 
		{
			this.particles.splice(i, 1);
		}
	}
}

Emitter.prototype.draw = function()
{	
	// Draw all the particles
	for(i = 0; i < this.particles.length; i++)
	{
		this.canvasContext.fillStyle = this.color; 
		this.canvasContext.beginPath();
		this.canvasContext.arc(this.particles[i].x, this.particles[i].y, this.size*this.particles[i].lifeSpan, 0, Math.PI*2, true); 
		this.canvasContext.fill();
	}
}

function Particle()
{	
	// Base particle
	this.x = 0;
	this.y = 0;
	this.velocityY = 0;
	this.velocityX = 0;
	this.lifeSpan = 1;
}

// Compare function for sorting pixel array
function compare(a,b)
{
	return (a.x - a.y) - (b.x - b.y);
}