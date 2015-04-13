console.log("Sup");

$("#menu-toggle").click(function() {
    console.log($("#title").val());
    $.ajax({
        url: 'query.php',
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
        url: 'query.php',
        data: {
            title: $("#title").val()
        },
        success: function(data) {
            $('#movieHint').html(data);
        }
    })
})