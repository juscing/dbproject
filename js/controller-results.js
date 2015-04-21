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

$('#genreDiv p').click(function() {

 	var genreType = $(this).text();
 	console.log(genreType);

    var res = $("#results");
    res.fadeOut(function () {
        res.empty();
        res.load("php/queryResults.php", { 
            genre: genreType,
        }, function () {
            res.fadeIn();
        });
    });
});

$('#directorDiv p').click(function() {

 	var directorName = $(this).text();
 	console.log(directorName);

    var res = $("#results");
    res.fadeOut(function () {
        res.empty();
        res.load("php/queryResults.php", { 
            director: directorName,
        }, function () {
            res.fadeIn();
        });
    });
});

$('#yearDiv p').click(function() {

 	var yearNumber = $(this).text();
 	console.log(yearNumber);

    var res = $("#results");
    res.fadeOut(function () {
        res.empty();
        res.load("php/queryResults.php", { 
            year: yearNumber,
        }, function () {
            res.fadeIn();
        });
    });
});
