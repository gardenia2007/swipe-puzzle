var SwipePuzzle = function(el, layout){
	this._layout = $.extend(SwipePuzzle.layout, layout);
	this._div = $(el);

	this.init();

	var jig = this;

	this._div.find('.block').click(function(){
		var pos = jig.getPos(this);
		if($(this).prop('id') != 'space')
		{
			jig.moveBlock(pos.row, pos.col);
		}
	});
};

SwipePuzzle.layout = {
	rows : 6, cols : 8, blockWidth : 50, blockHeight:50, image : 'SwipePuzzle.png', blankBg : 'blank.png'
};

SwipePuzzle.prototype = {
	init : function()
	{
		var cnt = $('<div class="swipe-puzzle"></div>').css({
			'width' : this._layout.blockWidth * this._layout.cols + 'px',
			'height' : this._layout.blockHeight * this._layout.rows + 'px',
			'background' : 'url('+ this._layout.blankBg +') repeat'
		});

		this.blocks = new Array(this._layout.rows);

		for(var i = 0; i < this._layout.rows; i++)
		{
			this.blocks[i] = new Array(this._layout.cols+1);

			for(var j = 0; j < this._layout.cols; j++)
			{
				this.blocks[i][j] = this.createBlock(i, j);
				cnt.append(this.blocks[i][j]);
			}
		}
		/* Create extra sapce */
		this._space = this.createBlock(this._layout.rows -1, this._layout.cols).addClass('space').css({
			'background' : 'url('+ this._layout.blankBg +') no-repeat left top'
		}).prependTo(cnt);

		this.blocks[this._layout.rows-1][this._layout.cols] = this._space;

		cnt.appendTo(this._div);
	},
	createBlock : function(row, col)
	{
		var left = this._layout.blockWidth * col, top = this._layout.blockHeight * row ;
		var bgleft = -1 * (left - col), bgtop = -1 * (top - row);
		return $('<div class="block" title="' +row+ '-' +col+ '"></div>').css({
			'background-image' : 'url(' + this._layout.image + ')',
			'background-position' : (bgleft-1) + 'px ' + (bgtop-1) + 'px',
			'width' : this._layout.blockWidth-1,
			'height' : this._layout.blockHeight-1,
			'left' : left +'px', 'top' : top + 'px'
		});
	},
	/* Swap block with the blank block */
	moveBlock : function(row, col)
	{
		if(!this.movable(row, col)) return;

		var title = row + '-' + col;
		var jig = $(this._div).find('div[title='+title+']');
		var space = this._space;

		var o = jig.position();

		var jig_pos = { left : o.left, top: o.top};
		var o = space.position();
		var space_pos = { left : o.left, top : o.top};
		
		jig.animate(space_pos, 200);
		space.animate(jig_pos, 200);

		var pos = this.getPos(jig);
		var spos = this.getPos(space);

		this.setPos(jig, spos.row, spos.col);
		this.setPos(space, pos.row, pos.col);

		this.blocks[spos.row][spos.col] = jig;
		this.blocks[row][col] = space;
	},
	getPos : function(el)
	{
		var pos = $(el).prop('title').split('-');
		return {
			row : parseInt(pos[0]), col : parseInt(pos[1])};
	},
	setPos : function(el, row, col)
	{
		$(el).prop('title', row + '-' + col);
	},
	movable : function(row, col)
	{
		var space = this.getPos(this._space);
		var allowed = [
			[ space.row -1, space.col ],
			[ space.row +1, space.col ],
			[ space.row, space.col -1 ],
			[ space.row, space.col +1 ]
		];

		for(var i = 0; i < allowed.length; i++)
		{
			var b = allowed[i];
			if(row == b[0] && col == b[1])
				return true;
		}
		return false;
	},
	locateBlock : function(block, row, col){
		this.setPos(block, row, col);

		block.css({
			top : this._layout.blockWidth * row,
			left : this._layout.blockHeight * col
		});
	},
	/* Shuffle the blocks using a seed. The same seed will generate the same layout. */
	shuffle : function(seed)
	{
		Math.seedrandom(seed);

		var filled = [];
		var num =  this._layout.rows * this._layout.cols;

		for(var i = 0; i < num; i++)
		{
			filled[i] = i;
		}

		for(var i = 0; i < 100; i++)
		{
			var a = Math.floor(Math.random() * num);
			var b = Math.floor(Math.random() * num);

			var t = filled[a];
			filled[a] = filled[b];
			filled[b] = t;
		}

		for(var i = 0; i < this._layout.rows; i++)
		{
			for(var j = 0; j < this._layout.cols; j++)
			{
				var x = filled[this._layout.cols *i +j];
				var row = parseInt(x / this._layout.cols);
				var col = x % this._layout.cols;
				this.locateBlock(this.blocks[i][j], row, col);
				//this.moveBlock(row, col);
			}
		}
	}
};
