console.log("Sup");

$("#menu-toggle").click(function() {
    var movieTitle = $('#title').val();
    console.log("Searching for " + movieTitle);
    $.ajax({
        url: 'php/queryFull.php',
        data: {
            title: movieTitle
        },
        success: function(data) {
            $('#main').hide()
            $('#results').html(data);
        }
    })
})

$("#title").keyup(function() {
    var movieTitle = $('#title').val();

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

$("#actor").keyup(function() {
    var actorName = $("#actor").val();
    if (actorName.length>0) {
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
        $('#actorName').empty();
    }
})

$("#keyword").keyup(function() {
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

$("#director").keyup(function() {
    var directorName = $('#director').val();
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