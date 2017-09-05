var Snake = Snake || {};

Snake.gridTypes = { FLOOR: 0, ENTITY_ONE: 1, ENTITY_TWO: 2,};
Snake.grid = [];
Snake.imageFiles = [];	
Snake.entity_one = [];
Snake.entity_two = [];
Snake.entity_one.moveX = 0;
Snake.entity_one.moveY = 0;
Snake.entity_two.moveX = 0;
Snake.entity_two.moveY = 0;
/*Snake.something = 0;*/

Snake.init = function (canvas, level, loadingCompleteCallback) {
	// load canvas
	Snake.canvasElement = document.getElementById(canvas);
	Snake.context = this.canvasElement.getContext("2d");
	
	Snake.loadImages();
	Snake.loadGrid();
	Snake.registerEvents();

	Snake.waitForImages(loadingCompleteCallback);
}

//move entity_one and two
Snake.move = function() {
	Snake.setPositionRedraw(Snake.entity_one[0].x, Snake.entity_one[0].y);
	moveEntity_oneX ();
	moveEntity_oneY ();
	Snake.entity_one[0].redraw = true;
	Snake.checkCollisions();
		
	Snake.setPositionRedraw(Snake.entity_two[0].x, Snake.entity_two[0].y);
	moveEntity_twoX ();
	moveEntity_twoY ();
	Snake.entity_two[0].redraw = true;
}	
	

Snake.checkCollisions = function (){
	//check for touch
	if(Snake.entity_one[0].x === Snake.entity_two[0].x && Snake.entity_one[0].y === Snake.entity_two[0].y){
		Snake.createSomething();
	}
}

//maakt de muren 'hard'
moveEntity_oneX = function(){
	if ((Snake.entity_one[0].x === 0 && Snake.entity_one.moveX === -1) || 
		(Snake.entity_one[0].x + Snake.entity_one.moveX === Snake.gridWidth)){
		Snake.entity_one.moveX = 0;
	}
	
	else {
		Snake.entity_one[0].x += Snake.entity_one.moveX;
	}
}

moveEntity_oneY = function(){
	if ((Snake.entity_one[0].y === 0 && Snake.entity_one.moveY === -1) || 
		(Snake.entity_one[0].y + Snake.entity_one.moveY === Snake.gridHeight)){
		Snake.entity_one.moveY = 0;
	}
		
	else {
		Snake.entity_one[0].y += Snake.entity_one.moveY;
	}
}

moveEntity_twoX = function(){
	if ((Snake.entity_two[0].x === 0 && Snake.entity_two.moveX === -1) || 
		(Snake.entity_two[0].x + Snake.entity_two.moveX === Snake.gridWidth)){
		Snake.entity_two.moveX = 0;
	}
	
	else {
		Snake.entity_two[0].x += Snake.entity_two.moveX;
	}
}

moveEntity_twoY = function(){
	if ((Snake.entity_two[0].y === 0 && Snake.entity_two.moveY === -1) || 
		(Snake.entity_two[0].y + Snake.entity_two.moveY === Snake.gridHeight)){
		Snake.entity_two.moveY = 0;
	}
		
	else {
		Snake.entity_two[0].y += Snake.entity_two.moveY;
	}
}