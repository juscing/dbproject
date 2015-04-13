console.log("Sup");

$("#menu-toggle").click(function() {
    console.log($("#title").val());
    $.ajax({
        url: 'php/queryFull.php',
        data: {
            title: $("#title").val()
        },
        success: function(data) {
            $('#movieHint').html(data);
        }
    })
})

$("#title").keyup(function() {
    console.log($("#title").val());
    $.ajax({
        type: "GET",
        url: 'php/queryTitle.php',
        data: {
            title: $("#title").val()
        },
        success: function(data) {
            $('#movieHint').html(data);
        }
    })
})

$("#actor").keyup(function() {
    console.log($("#actor").val());
    $.ajax({
        type: "GET",
        url: 'php/queryActor.php',
        data: {
            actor: $("#actor").val()
        },
        success: function(data) {
            $('#actorHint').html(data);
        }
    })
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
    console.log($("#director").val());
    $.ajax({
        type: "GET",
        url: 'php/queryDirector.php',
        data: {
            director: $("#director").val()
        },
        success: function(data) {
            $('#directorHint').html(data);
        }
    })
})