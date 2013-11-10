var showSpotPopup = function($that) {
	$("#spotPopup"+$that.attr("id")).slideDown('400');
};

var showComments = function(commentsList) {
	for (comment in commentList) {
		console.log(comment);
	}
}

$(document).ready(function() {
	
	$(".spot").on('click', function() {
		showSpotPopup(this);
		commentsList=getComments(this.attr("id"));
		showComments(commentsList);
	});

});