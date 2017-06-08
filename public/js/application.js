/* 
 *
 * basic class to edit data tables
 * TODO implement refresh of data
 *
 * ------------------------------------------------------- */
var DataTable = new Class({
	Implements : [Options, Events],
	options : {
		container : false,
		updateUrl : false,
		deleteUrl : false,
		insertForm:false
	},
	initialize : function(options) {
		this.setOptions(options);
		this.form=document.id(this.options.container).getElement('form');
		this.table = document.id(this.options.container).getElement('table');
		
		console.log('initialize datatable');
			this.editable();
			this.formEvent();
	},
	editable : function() {
	
		console.log('editable');
		/* save vars to be reachable in the scopes below and skip bindings */
		var updateUrl = this.options.updateUrl;
		var deleteUrl = this.options.deleteUrl;
		var container= this.options.container; 	
		var table=this.table;
		
		table.getElements('td').each(function(el) {
		
			//add double-click and blur events
			if(el.getElement('span') !== null) {
				el.addEvent('dblclick', function(e) {

			/* take affected row id from tr id*/
			var rowid = this.getParent('tr').get('id');
			/* take the affected column name from id of the table headers*/
			var column = table.rows[0].cells[el.cellIndex].get('id');
			
					var span = el.getElement('span');
					//store "before" message
					var before = span.get('text').trim();
					var beforehtml = span.get('html').trim();
					//erase current
					span.set('html', '');

					var input = new Element('input', {
						'class' : 'box',
						'value' : before
					});
					//blur input when they press "Enter"
					input.addEvent('keydown', function(e) {
						if(e.key == 'enter') {
							this.fireEvent('blur');
						}
					});

					input.inject(span).select();
					//add blur event to input
					input.addEvent('blur', function() {
						//get value, place it in original element
						var fieldcontent = input.get('value').trim();
						span.set('text', fieldcontent);

						var request = new Request({
							method : 'post',
							url : updateUrl + '/' + rowid ,
							data : {
								field : column,
								useSpinner : true,
								value : fieldcontent
							},
							onSuccess : function(result) {
								if(result == true) {
									messageText='Succesful update';
								}
								else{
									
									messageText='Error';
								}
								var message = new Notification({
										text : messageText,
										container:container
									});
							}
						}).send();
					});
				});
			} 
			if(el.get('class') == 'delete') {

				el.addEvent('click', function(e) {
					
			/* take affected row id from tr id*/
			var rowid = this.getParent('tr').get('id');
			/* take the affected column name from id of the table headers*/ 
					console.log('delete click');
					var conf = confirm('Cancel ?');
					if(conf) {
						var request = new Request({
							url : deleteUrl + '/' + rowid ,
							data : {
								useSpinner : true
							},
							onSuccess : function(result) {

								if(result == true) {
									el.getParent('tr').fade('out');
								}

							},
							method : 'post'

						}).send();
					}
				});
			}

		});
	},
	formEvent:function(){
		this.form.addEvent('submit',function(e){
			e.stop();
				var request = new Request({
							method : 'post',
							url : this.get('action') ,
						 
							onSuccess : function(result) {
								if(result == true) {
									window.location = self.location;
								}
								else{
									
									messageText='Error';
									var message = new Notification({
										text : messageText,
										container:container
									});
								}
								
							}
						}).send(this);
			
		});
		
	}
});
/**
 * barebone notification class
 * 
 * */
var Notification = new Class({
	Implements : [Options, Events],
	options : {
		id:'message',
		text : '',
		container:document.body
	},  
	initialize : function(options) {
		this.setOptions(options);
		this.element=new Element('div',{'id':this.id,'class':'message','text' : this.options.text});
		this.show();
	}, 
	show : function() {  
		this.element.inject(document.id(this.options.container));
		
		(function(){this.element.fade('out')}).delay(1000,this);
		this.fireEvent('show');
	} 
});

window.addEvent('load', function() {
	if(document.id('main')){
	var mainTable = new DataTable({
		container : 'main',
		updateUrl : 'main/update',
		deleteUrl : 'main/delete',
		insertForm:true
	})
	
	
	}
});
