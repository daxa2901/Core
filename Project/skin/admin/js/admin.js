var admin ={

	url : null,
	data : {},
	type : 'POST',
	dataType : 'json',
	form : null,

	setUrl : function (url) {
		this.url = url;
		return this;
	},

	getUrl : function () {
		return this.url;
	},

	setData : function (data) {
		this.data = data;
		return this;
	},

	getData : function () {
		return this.data;
	},
	setType : function (type) {
		this.type = type;
		return this;
	},

	getType : function () {
		return this.type;
	},
	setDataType : function (dataType) {
		this.dataType = dataType;
		return this;
	},

	getDataType : function () {
		return this.dataType;
	},
	setForm : function(form) {
		this.form = form;
		this.prepareFormParams();
		return this;
	},

	getForm : function () {
		return this.form;
	},

	prepareFormParams : function () {
		this.setType(this.getForm().attr('method'));
		this.setUrl(this.getForm().attr('action'));
		this.setData(this.getForm().serializeArray());
		return this;
	},

	load : function (){
		const self = this;
		$.ajax({

			url: this.getUrl(),
			type: this.getType(),
			data : this.getData(),
			success : function (data) {
				self.manageElements(data.elements);
			},
			dataType : this.getDataType()

		});
	},

	manageElements : function (elements) {
		jQuery(elements).each(function (index,element) {
			jQuery(element.element).html(element.content);
		})
	}
}

$(document).ready(function () {
	
})