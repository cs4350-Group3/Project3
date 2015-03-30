$('#btn').click(function(){
    username=$("input[name='username']").val();
    password=$("input[name='password']").val();
    
    if(username === "" || password === "") {
        alert('You have an empty field.');
        return;
    }

    $.ajax({
        type: "POST",
        url: "/auth",
        data: "name="+username+"&pass="+password,
        success: function(data){
            $( ".result" ).html( '<p>' + data + '</p>' );
        }
    });
});