$('#actorDiv span').click(function() {
 	var actorName = $(this).text();
 	console.log(actorName);

    var res = $("#results");
    res.fadeOut(function () {
        res.empty();
        res.load("php/queryResults.php", { 
            actor: actorName,
        }, function () {
            res.fadeIn();
        });
    });

});