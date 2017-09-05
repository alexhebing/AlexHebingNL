var Snake = Snake || {};

Snake.loadGrid = function() {
	// set up grid (800x600 resolution gives us a 20x15 grid of images 40x40 pixels
	Snake.gridWidth = 20;
	Snake.gridHeight = 15;
	Snake.gridElementWidth = Snake.canvasElement.width / Snake.gridWidth;
	Snake.gridElementHeight = Snake.canvasElement.height / Snake.gridHeight;
	
	for(var y = 0; y < Snake.gridHeight; y++) {
		for(var x = 0; x < Snake.gridWidth; x++) {
			Snake.grid.push(new Snake.gridItem(x,y, Snake.gridTypes.FLOOR));
		}
	}

	// initialize entity one
	Snake.entity_one.push(new Snake.gridItem(Math.floor(Snake.gridWidth - 2), 
										Math.floor(Snake.gridHeight - 2), 
										Snake.gridTypes.ENTITY_ONE));

	// initialize entity two
	Snake.entity_two.push(new Snake.gridItem(Math.floor(Snake.gridWidth / 20), 
										Math.floor(Snake.gridHeight / 15), 
										Snake.gridTypes.ENTITY_TWO));

}

Snake.drawGrid = function() {
	for(var i = 0; i < Snake.grid.length; i++) {
		Snake.grid[i].draw(Snake.context);
	}

	// draw entity_one
	for(var s = 0; s < Snake.entity_one.length; s++) {
		Snake.entity_one[s].draw(Snake.context);
	}

		// draw entity_two
	for(var s = 0; s < Snake.entity_two.length; s++) {
		Snake.entity_two[s].draw(Snake.context);
	}
}

Snake.setPositionRedraw = function(x,y)
	{
		var index = y * Snake.gridWidth + x;
		Snake.grid[index].redraw = true;
	}

Snake.createSomething = function() {
			alert('Touch!');
	}

Snake.gridItem = function(x, y, type) {
	var self = this;
	
	this.redraw = true;
	this.x = x;
	this.y = y;
	this.type = type;
	
	// draws this grid tile at its proper location
	this.draw = function(context) {
		if(self.redraw) {
			var img = Snake.imageFiles[self.type][1];
			context.drawImage(img, 0, 0, img.width, img.height, self.x * Snake.gridElementWidth, self.y * Snake.gridElementHeight, Snake.gridElementWidth, Snake.gridElementHeight);	
			self.redraw = false;
		}
	}
}