

  // Edit  touristic site

$(".editBtn").click(function() {

    // get table row value
    var $row = $(this).closest("tr");    // Find the row
    var $id = $row.find(".id").text(); // Find the text
    var $site_ = $row.find(".site_name").text(); // Find the text
    var $_caption_one = $row.find(".photo_caption_one").text(); // Find the text
     var $_caption_two = $row.find(".photo_caption_two").text(); // Find the text
    var $google_ = $row.find(".google_map").text(); // Find the text


    // set table row values to the form 
 
 
     document.getElementById("Id").value = $id ;
    document.getElementById("site").value = $site_ ;

    // document.getElementById("pto").value = $img ;
        document.getElementById("pc_one").value = $_caption_one;
            document.getElementById("pc_two").value = $_caption_two;
                document.getElementById("coord").value = $google_;
});


// Update image script
$(".edingBtn").click(function() {

    // get table row value
    var $row = $(this).closest("tr");    // Find the row
    var $idimage = $row.find(".id").text();

     // set table row values to the form 
     document.getElementById("IdImage").value = $idimage ;
    });



$(".deleBtn").click(function() {

    // get table row value
    var $row = $(this).closest("tr");    // Find the row
    var $id = $row.find(".id").text(); // Find the text

    // set table row values to the form 
 
    document.getElementById("Id_delete").value = $id ;


}) ;