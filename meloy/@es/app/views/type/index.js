Tea.View.scope(function () {
	this.openViewPort = function (doc, index) {
		if (doc.isOpen) {
			return;
		}

		var box = document.getElementById("docs-box");
		var docElements = box.getElementsByClassName("doc");
		var element = docElements[index];
		var beforeHeight = element.offsetHeight;

		doc.isOpen = true;

		setTimeout(function () {
			var afterHeight = element.offsetHeight;
			if (beforeHeight == afterHeight) {
				doc.isOpen = false;
				Tea.View.update();
			}
		}, 10);
	};

	this.closeViewPort = function (doc) {
		doc.isOpen = false;
	};

	this.searchKeyword = function () {
		Tea.go(".index", {
			"serverId": this.server.id,
			"index": this.index.name,
			"type": this.type.name,
			"search": "q",
			"q": this.q,
			"listStyle": this.listStyle
		});
		return false;
	};

	this.clearQ = function () {
		this.q = "";
	};

	this.deleteDoc = function (doc) {
		if (!window.confirm("确定要删除此文档吗？")) {
			return;
		}

		doc.loading = true;
		doc.loadingText = "删除中";

		Tea.action(".deleteDoc")
			.params({
				"serverId": this.server.id,
				"index": this.index.name,
				"type": this.type.name,
				"id": doc._id
			})
			.post();
	};

	this.setListStyle = function (listStyle) {
		var search = window.location.search;
		if (search.match(/&listStyle=\w+/)) {
			search = search.replace(/&listStyle=\w+/, "&listStyle=" + listStyle);
		}
		else {
			search = search + "&listStyle=" + listStyle;
		}
		window.location = window.location.pathname + search;
	};
});
