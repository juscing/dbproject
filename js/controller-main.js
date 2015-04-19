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
            $('#movieHint').html(data);
            $('#main').hide();
            $('#results').html(data);
        }
    })
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