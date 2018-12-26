$(document).ready(function(){
    
    //Retrieves all exhibitions and writes them out in the sidebar to the left
    $.getJSON("/classes/view/Exhibitions.php",function(exhibitions){
        for(var i = 0; i < exhibitions.length; i++){
           $(".exhibition_list").append("<li class='exhibition_select' id='"+exhibitions[i]['utställningsid']+"'>"+exhibitions[i]['titel']+"</li>");
        }
    });

    //Retrieves all guides and writes them out in the sidebar to the left
    $.getJSON("/classes/view/getGuides.php",function(guides){
        for(var i = 0; i < guides.length; i++){
           $(".guide_list").append("<li class='guide_select' id='"+guides[i]['personnr']+"'>"+guides[i]['fnamn']+" "+guides[i]['enamn']+"</li>");
        }
    });

    //Retrieves the exhibtion and all tours for the picked exhibition and writes them out in the display window 
    $("body").on( "click",".exhibition_select", function() {
        $(".display").html("<div class='exhibition_title'></div><div class='exhibition_tours'></div>");
        $(".edit_guide").hide();
        $(".controls").hide();
        var exhID = $(this).attr("id");
        $.getJSON("/classes/view/getExhibition.php", {getExpedition:true, exhID: exhID}, function(exhibition){
            $(".exhibition_title").html("<h1>"+exhibition[0]['titel']+" - "+exhibition[0]['startdatum']+" till "+exhibition[0]['slutdatum']+"</h1>");
            $(".exhibition_title").append("<h2>"+"Guidade turer:"+"</h2>");

            $.getJSON("/classes/view/getExhibition.php", {getExpeditionTour:true, exhID: exhID}, function(tours){
                $.getJSON("/classes/view/getExhibition.php", {getExpeditionGuides:true}, function(guides){
                    $(".exhibition_tours").html("");
                    for(var i = 0; i < tours.length; i++){
                        $(".exhibition_tours").append("<p>"+
                        "Datum: "+tours[i]['datum']+
                        " Börjar: "+tours[i]['starttid']+
                        " Slutar: "+tours[i]['sluttid']+
                        "<br>Turen hålls på : "+tours[i]['språk']+
                        " och eran guide kommer att vara : "+guides[tours[i]['guide']]+
                        "<br><br><span class='exhibition_tour' id='"+tours[i]['utställning']+"</span><br>"+
                        "</p>");
                        }
                });
            });
        });
    });

    //Retrieves all information, competences and languages knowledge about the picked guide 
    //and his/her tours and wirtes them out in the display window
        $("body").on( "click",".guide_select", function() {
        $(".display").html("<div class=guide_display><div class='guide_name'></div>"+
        "<div class='guide_competences'>"+
        "<ul class='guide_language'><br><h2>Språkkunskap</h2></ul>"+
        "<ul class='guide_exhibitions'><br><h2>Uställningscertifikat</h2></ul>"+
        "</div>"+
        "<div class='guide_tours'><h2>Guidade turer:</h2></div>"+
        "</div>");
        $(".edit_guide").show();
        $(".controls").hide();
        $(".lang").html("");
        $(".comp").html("");
        var pnr = $(this).attr("id");
        $.getJSON("/classes/view/getGuideInfo.php", {getGuideLanguages:true, pnr: pnr}, function(guide){
            $(".guide_name").html("<h1>"+guide[0]['fnamn']+" "+guide[0]['enamn']+
            " <br>Tel. "+
            guide[0]['tel']+
            " <br>Email. "+
            guide[0]['email']+
            "</h1>");
            for(var i = 0; i < guide.length; i++){
                $(".guide_language").append("<p>"+guide[i]['språk']+"</p>");
            }
            $.getJSON("/classes/view/getGuideInfo.php", {getGuideCompetence:true, pnr: pnr}, function(exhibitions){
          
                for(var i = 0; i < exhibitions.length; i++){
                    $(".guide_exhibitions").append("<p>"+exhibitions[i]['titel']+"</p>");
                }
            });
            $.getJSON("/classes/view/getGuideInfo.php", {getGuideTours:true, pnr: pnr}, function(tours){
                console.log(tours);
                for(var i = 0; i < tours.length; i++){
                    $(".guide_tours").append("<h2>"+tours[i]['titel']+"</h2>")
                    $(".guide_tours").append("<p>"+
                        "Datum: "+tours[i]['datum']+
                        " "+tours[i]['starttid']+
                        " till "+tours[i]['sluttid']+
                        " Språk: "+tours[i]['språk']+
                    "</p>"); 
                }
            });
        });
    });
//when pressing the edit guide button either shows or hides the edit language and certificate
    $(".edit_guide").click(function(){
        if ($(".controls").css("display") == "none") {
            $(".controls").css("display", "inline-block");
            $("#edit_competence").show();
            $("#edit_language").show();
        } else {
            $(".controls").hide();
            $(".lang").html("");
            $(".comp").html("");
        }
      });
// when pressing the edit language button add and remove buttons will show up
      $("#edit_language").click(function(){
        $("#edit_competence").hide();
        $(".lang").html("<p> Välj lägg till eller ta bort</p>");
        $(".lang").append("<button class='lang_action_add'>Lägg till</button>");
        $(".lang").append("<button class='lang_action_remove'>Ta bort</button>");
      });
// when pressing the edit competence button add and remove buttons will show up
      $("#edit_competence").click(function(){
        $("#edit_language").hide();
        $(".comp").html("<p> Välj lägg till eller ta bort</p>");
        $(".comp").append("<button class='comp_action_add'>Lägg till</button>");
        $(".comp").append("<button class='comp_action_remove'>Ta bort</button>");
    });

// When pressing the add button all possible languges to add for the current guide is 
//shown as buttons and add and remove button will disappear
    $("body").on( "click",".lang_action_add", function() {
        $.getJSON("/classes/view/editGuide.php",{getSelectLang: true},function(languages){
            if(languages.length > 0){
                $(".lang").html("<p>Klicka på ett språk för att lägga till det<p>");
            } else {
                $(".lang").html("<br><p>Guiden talar redan alla möjliga språk!<p>");
            }
            for(var i = 0; i < languages.length;i++){
                $(".lang").append("<button class='lang_pick'>"+languages[i]['namn']+"</button>");
                if((i+1)%3 == 0){
                    $(".lang").append("<br>");
                }
            }
        });
    });

// When pressing the add button all possible competences to add for the current guide is 
//shown as buttons and add and remove button will disappear
$("body").on( "click",".comp_action_add", function() {
    $.getJSON("/classes/view/editGuide.php",{getSelectComp: true},function(competences){
        if(competences.length > 0){
            $(".comp").html("<p>Klicka på en utställning för att lägga till den<p>");
        } else {
            $(".comp").html("<br><p>Guiden är redan certifierad för alla kompetenser!<p>");
        }
        for(var i = 0; i < competences.length;i++){
            $(".comp").append("<button class='comp_pick' id='"+competences[i]['utställningsid']+"'>"+competences[i]['titel']+"</button>");
            if((i+1)%2 == 0){
                $(".comp").append("<br>");
            }
        }
    });
});
    

//when clicking a language button the language clicked will be added
    $("body").on( "click",".lang_pick", function() {
        var lang = $(this).text();
        $.getJSON("/classes/view/editGuide.php",{addLanguage: true, lang: lang},function(attempt){
            console.log(attempt);
            if(attempt){
                $(".lang").html("<p>"+lang+" har lagts till!</p>");
                $.getJSON("/classes/view/editGuide.php", {getGuideLanguages:true}, function(guide){
                    $(".guide_language").html("<br><h2>Språkkunskap</h2>");
                    $(".guide_language").css("display", "none");
                    for(var i = 0; i < guide.length; i++){
                        $(".guide_language").append("<p>"+guide[i]['språk']+"</p>");
                    }
                    $(".guide_language").css("display", "none").show("slow");
                });
            } else {
                $(".lang").html("<p>Språket lades inte till, testa igen!</p>");
            }
        });
        $("#edit_competence").hide();
        $("#edit_language").hide();
    });

//when clicking a competence button the competence clicked will be added
$("body").on( "click",".comp_pick", function() {
    var comp = $(this).attr("id");
    var title = $(this).text();

    $.getJSON("/classes/view/editGuide.php",{addCompetence: true, comp: comp},function(attempt){
        console.log(attempt);
        if(attempt){
            $(".comp").html("<p>"+title+" har lagts till!</p>");

            $.getJSON("/classes/view/editGuide.php", {getGuideCompetences:true}, function(competences){
                $(".guide_exhibitions").html("<br><h2>UtställningCertifikat</h2>");
                $(".guide_exhibitions").css("display", "none");
                for(var i = 0; i < competences.length; i++){
                    $(".guide_exhibitions").append("<p>"+competences[i]['titel']+"</p>");
                }
                $(".guide_exhibitions").css("display", "none").show("slow");
            });
        } else {
            $(".comp").html("<p>Kompetensen lades inte till, testa igen!</p>");
        }
    });
    $("#edit_competence").hide();
    $("#edit_language").hide();
});

// When pressing the remove button all possible competences to remove for the current guide is 
//shown as buttons and add and remove button will disappear
$("body").on( "click",".comp_action_remove", function() {
    $.getJSON("/classes/view/editGuide.php",{getRemovableComp: true},function(competences){
        if(competences.length > 0){
            $(".comp").html("<p>Klicka på en utställning för att ta bort den<p>");
        } else {
            $(".comp").html("<br><p>Guiden har ingen kompetens som går att ta bort!<p>");
        }
        for(var i = 0; i < competences.length;i++){
            $(".comp").append("<button class='comp_remove' id='"+competences[i]['utställningsid']+"'>"+competences[i]['titel']+"</button>");
            if((i+1)%2 == 0){
                $(".comp").append("<br>");
            }
        }
    });
});
// When pressing the remove button all possible languages to remove for the current guide is 
//shown as buttons and add and remove button will disappear
$("body").on( "click",".lang_action_remove", function() {
    $.getJSON("/classes/view/editGuide.php",{getRemovableLang: true},function(languages){
        if(languages.length > 0){
            $(".lang").html("<p>Klicka på ett språk för att ta bort det<p>");
        } else {
            $(".lang").html("<br><p>Guiden har inget språk som går att ta bort!<p>");
        }
        for(var i = 0; i < languages.length;i++){
            $(".lang").append("<button class='lang_remove'"+"'>"+languages[i]['språk']+"</button>");
            if((i+1)%2 == 0){
                $(".lang").append("<br>");
            }
        }
    });
});
//when clicking a competence button the competence clicked will be removed
$("body").on( "click",".comp_remove", function() {
    var comp = $(this).attr("id");
    var title = $(this).text();

    $.getJSON("/classes/view/editGuide.php",{removeCompetence: true, comp: comp},function(attempt){
        console.log(attempt);
        if(attempt){
            $(".comp").html("<p>"+title+" har tagits bort!</p>");

            $.getJSON("/classes/view/editGuide.php", {getGuideCompetences:true}, function(competences){
                $(".guide_exhibitions").html("<br><h2>UtställningCertifikat</h2>");
                $(".guide_exhibitions").css("display", "none");
                for(var i = 0; i < competences.length; i++){
                    $(".guide_exhibitions").append("<p>"+competences[i]['titel']+"</p>");
                }
                $(".guide_exhibitions").css("display", "none").show("slow");
            });
        } else {
            $(".comp").html("<p>Kompetensen togs inte bort, testa igen!</p>");
        }
    });
    $("#edit_competence").hide();
    $("#edit_language").hide();
});

//when clicking a language button the language clicked will be removed
$("body").on( "click",".lang_remove", function() {
    var lang = $(this).text();
    $.getJSON("/classes/view/editGuide.php",{removeLanguage: true, lang: lang},function(attempt){
        console.log(attempt);
        if(attempt){
            $(".lang").html("<p>"+lang+" har tagits bort!</p>");
            $.getJSON("/classes/view/editGuide.php", {getGuideLanguages:true}, function(languages){
                $(".guide_language").html("<br><h2>Språkkunskap</h2>");
                $(".guide_language").css("display", "none");
                for(var i = 0; i < languages.length; i++){
                    $(".guide_language").append("<p>"+languages[i]['språk']+"</p>");
                }
                $(".guide_language").css("display", "none").show("slow");
            });
        } else {
            $(".lang").html("<p>Språket togs inte bort, testa igen!</p>");
        }
    });
    $("#edit_competence").hide();
    $("#edit_language").hide();
});






































 
});


