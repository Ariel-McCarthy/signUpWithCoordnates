<!DOCTYPE html>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        
        <meta charset="UTF-8">
        <title>AJAX: Sign Up Page</title>

        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <link href = "CSS/styles.css" rel = "stylesheet" type = "text/css" />
        
        <script>
            function validateForm() 
            {
                return false;
            }
        </script>
        
        <script> 
            $(document).ready( function()
            {
                $("submit").click(function()
                {
                    if(dontMatch)
                    {
                        alert("Passwords don't match");
                    }
                })
                
                $("#username").change(function()
                {
                    //alert(  $("#username").val() );
                    $.ajax(
                    {
                        type: "GET",
                        url: "checkUserName.php",
                        dataType: "json",
                        data: { "username": $("#username").val() },
                        success: function(data,status) 
                        {
                            if (!data) 
                            {  
                                //data == false
                                alert("Username is AVAILABLE!");
                            } 
                            else 
                            {
                                alert("Username ALREADY TAKEN!");
                            }
                        },
                        complete: function(data,status) 
                        { 
                            // optional, used for debugging purposes
                            // alert(status);
                            // alert(  $("#username").val() );
                        }
                    });//ajax
                });
                
                $("#password2").change(function()
                {
                    var password1 = $("#password1").val();
                    var password2 = $("#password2").val();
                    
                    //alert(  $("#password").val());
                    if (password1 != password2) 
                    {  
                        $("#pass").html("Error: Non-matching passwords");
                        $("#pass").css("color", "red");
                        
                        dontMatch = false;
                    } 
                    else
                    {
                        $("#pass").html("Passwords match!");
                        $("#pass").css("color", "navy");
                        
                        dontMatch = true;
                    }
                });
                
                $("#state").change(function() 
                {
                    //alert($("#state").val());
                    $.ajax(
                    {
                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/countyList.php",
                        dataType: "json",
                        data: { "state": $("#state").val()},
                        success: function(data,status) 
                        {
                            //   alert(data[0].county);
                            $("#county").html("<option> - Select One -</option>");
                            for(var i = 0; i < data.length; i++)
                            {
                                 $("#county").append("<option>" + data[i].county + "</option>");
                            }
                        },
                        complete: function(data,status) 
                        { 
                            //optional, used for debugging purposes
                            //alert(status);
                        }
                    });//ajax
                });
                $("#zipCode").change( function()
                {  
                    //alert( $("#zipCode").val() );  
                    $.ajax(
                    {
                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php",
                        dataType: "json",
                        data: { "zip": $("#zipCode").val()   },
                        success: function(data,status) 
                        {
                            //alert(data.city);
                            //alert(data.latitude);
                            //alert(data.longitude);
                            $("#city").html(data.city);
                            $("#latitude").html(data.latitude);
                            $("#longitude").html(data.longitude);
                            if(!data)
                            {
                                $("#zip").html("Error: Not a zipcode");
                                $("#zip").css("color", "red");   
                            }
                        },
                        complete: function(data,status) 
                        { 
                            //optional, used for debugging purposes
                            //alert(status);
                        }
                    });//ajax
                });
            }); //documentReady
        </script>
    </head>
    <body style="text-align:center; background-image: url('http://www.dmc.tv/download.php?file=wallpapers/4096_1024x768.jpg')">
    
        <h1> Sign Up Form </h1>
    
        <form onsubmit="return validateForm()">
            <fieldset>
               <legend></legend>
                First Name:  <input type="text"><br> 
                Last Name:   <input type="text"><br> 
                Email:       <input type="text"><br> 
                Phone Number:<input type="text"><br><br>
                Zip Code:    <input type="text" id="zipCode">
                    <span id="zip"></span>
                    <br>
                City:        <span id="city"></span>
                <br>
                Latitude:    <span id="latitude"></span>
                <br>    
                Longitude:   <span id="longitude"></span>
                <br><br>
                <div style="color: white">
                State: 
                </div>
                <select id="state">
                    <option value="">Select One</option>
                    <option value="ca"> California</option>
                    <option value="ny"> New York</option>
                    <option value="tx"> Texas</option>
                    <option value="va"> Virginia</option>
                </select><br />
                <div style="color: white">
                Select a County: </div> <select id="county"></select><br>
                
                <div style="color: white">
                Desired Username: </div> <input type="text" id = "username">
                    <span id="user"></span>
                    <br>
                <div style="color: white">
                Password: </div> <input type="password" id="password1"><br>
                <div style="color: white">
                Type Password Again: </div> <input type="password" id="password2">
                    <span id="pass"></span>
                    <br>
                </div>
                <input type="submit" value="Sign up!">
                <br />
            </fieldset>
        </form>
    </body>
</html>