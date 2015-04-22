console.log("Sup");

$(".actorLink").click(function() {
    var movieTitle = this.text();
    console.log("Searching for " + movieTitle);
    var res = $("#results");
    res.fadeOut(function () {
        res.empty();
        res.load("php/queryFull.php", { 
            title: movieTitle,
        }, function () {
            res.fadeIn();
        });
    });
})

$("#menu-toggle").click(function() {
    var movieTitle = $('#title').val();
    var actor = $('#actor').val();
    var director = $('#director').val();
    var genre = $('#genre').text().length > 20 ? "" : $('#genre').text();
    var year = $('#year').text().length > 20 ? "" : $('#year').text();
    var minCRating = $('#crating').text().length > 20 ? "" : $('#crating').text();
    var minURating = $('#urating').text().length > 20 ? "" : $('#urating').text();

    console.log("Searching for " + movieTitle);
    console.log("Searching for " + actor);
    console.log("Searching for " + director);
    console.log("Searching for " + genre);
    console.log("Searching for " + year);
    console.log("Searching for " + minCRating);
    console.log("Searching for " + minURating);
    var res = $("#results");
    res.fadeOut(function () {
        res.empty();
        res.load("php/queryFull.php", { 
            title: movieTitle,
            actor: actor,
            director: director,
            genre: genre,
            year: year,
            cRating: minCRating,
            uRating: minURating
        }, function () {
            res.fadeIn();
        });
    });
})

$("#title").on("change keyup paste", function() {
    var movieTitle = $('#title').val();
    console.log(movieTitle);
    if(movieTitle.length>0) {
        $.ajax({
            type: "GET",
            url: 'php/queryTitle.php',
            data: {
                title: movieTitle
            },
            success: function(data) {
                $('#movieHint').html(data);
            }
        })
    } else {
        $('#movieHint').empty();
    }
})

$("#actor").on("change keyup paste", function() {
    var actorName = $("#actor").val();
    if (actorName.length>0) {
        console.log(actorName);
        $.ajax({
            type: "GET",
            url: 'php/queryActor.php',
            data: {
                actor: actorName
            },
            success: function(data) {
                $('#actorHint').html(data);
            }
        })
    } else {
        $('#actorHint').empty();
    }
})

$("#keyword").on("change keyup paste", function() {
    console.log($("#keyword").val());
    $.ajax({
        type: "GET",
        url: 'php/queryKeyword.php',
        data: {
            keyword: $("#keyword").val()
        },
        success: function(data) {
            $('#keywordHint').html(data);
        }
    })
})

$("#director").on("change keyup paste", function() {
    var directorName = $('#director').val();
    console.log(directorName);
    if (directorName.length>0) {
        $.ajax({
            type: "GET",
            url: 'php/queryDirector.php',
            data: {
                director: directorName
            },
            success: function(data) {
                $('#directorHint').html(data);
            }
        })
    } else {
        $('#directorHint').empty();
    }
})