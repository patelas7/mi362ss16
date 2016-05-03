function Tasks() {
    this.id = 0;
    this.day = '';
    var that = this;

    // Handle the click of the plus sign
    $("div.day > a").click(function(event) {
        event.preventDefault();     // Don't allow it to submit the form
        that.id = 0;
        that.day = $(this).next().text();
        that.overlayPopUp();

    });


    if($("div.day-tasks a").length){
        $("div.day-tasks a").click(function(event){
            event.preventDefault();
            that.id = $(this).next().val();
            var data = {getTask: "getTask", id: that.id};
            var formTasks = $(this).parents('form');
            that.ajaxCall(formTasks, data);

        });
        this.displayPriority();
    }


    this.listenerOverlay();
}

Tasks.prototype.overlayPopUp = function(){
    if($("div.overlay").css('visibility') == 'visible'){
        $("div.overlay").fadeOut(1000, function() {
            $(this).show().css({visibility: "hidden"});
        });
    }
    else{
        var data = null;
        this.updateForm(data);
        $("div.overlay").css('visibility', 'visible').hide().fadeIn(1000);

    }

}

Tasks.prototype.ajaxCall = function(sel, dataSent){
    var that = this;
    $.ajax({
        url: "post/ajax-post.php",
        data: dataSent,
        method: "POST",
        success: function(data) {
            var json = JSON.parse(data);
            if(json.ok) {
                // Successful
                that.day = json.day;
                that.overlayPopUp();
                that.updateForm(json);


            } else {
                // Failed, a message is in json.message
                $(sel + " .message").html(json.message);

            }
        },
        error: function(xhr, status, error) {
            console.log(error);
            $(sel + " .message").html("Error: " + error );
        }
    });
}

Tasks.prototype.listenerOverlay = function() {

    var that = this;
    $("div.overlay a").click(function(event){
        event.preventDefault();
        that.overlayPopUp();
    });

    $("#delete").click(function(event){
        event.preventDefault();
        var form = $(this).parent();
        if(that.id == 0){
            that.overlayPopUp();
            return;
        }
        if(confirm('Are you sure you want to delete?')) {
            var html = '<input type="hidden" name="id" value="' + that.id + '">';
            html += '<input type="hidden" name="delete" value="delete">';
            form.append(html);
            form.submit();
        }
    });

    $("#edit").click(function(event){
        event.preventDefault();
        var html = '';
        console.log("id " + that.id);
        var form = $(this).parent();
        var title = form.find("[name='title']").val();
        if (title == ''){
            form.find(".message").html("Please enter a title");
            return;
        }

        if(that.id == 0){
            html += '<input type="hidden" name="add" value="add">';
        }
        else{

            html += '<input type="hidden" name="edit" value="edit">';
            html += '<input type="hidden" name="id" value="' + that.id + '">';
        }

        html += '<input type="hidden" name="day" value="' + that.day +'">';
        form.append(html);
        form.submit();

    });

}

Tasks.prototype.updateForm = function(data){
    var form = $(".addForm");
    if(data !== null) {

        form.find("[name='title']").val(data.title);
        form.find(".notes").val(data.notes);
        form.find("#priority").val(data.priority);
    }
    else{
        form.find("[name='title']").val('');
        form.find(".notes").val('');
        form.find("#priority").val("1");
    }

}

Tasks.prototype.displayPriority = function(){
    var priorities = $("div.day-tasks a").next().next();
    for(var p=0; p<priorities.length; p++){
        var priority = $(priorities.get(p));
        console.log(priority.val());
        if(priority.val() == "1"){
            priority.parent().css("background-color", "#ff5a00");
        }
        else if(priority.val() == "2"){
            priority.parent().css("background-color", "#FFC266");
        }
        else if(priority.val() == "3"){
            priority.parent().css("background-color", "#fafad2");
        }
    }
}


