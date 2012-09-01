
var contentcolumn = $('#contentcolumn'); // Cache storage of the contentcolumn

var currentPage; // Current page the user is viewing on the site



// Cached Nav object id's
var home_nav;
var committees_nav;
var what_is_afc_nav;
var meet_the_staff_nav;
var events_nav;
var history_nav;
var overview_nav;
var buddy_huddle_nav;
var afc_11_12_nav;
var afc_10_11_nav;
var afc_09_10_nav;
var AFC_1011_Staff_Button;
var AFC_1011_Boys_Button;
var AFC_1011_Girls_Button;




function changeCurrentPage(page) {

    $currentPage.removeClass("current");

    currentPage = page;

    $currentPage.addClass("current");


}

$(window).load(function() {

    contentcolumn.load('main_page.html');

    home_nav = $('#home_nav');

    currentPage = home_nav; // Set the current page to the home page


    changeCurrentPage(home_nav);




    committees_nav = $('#committees_nav');
    what_is_afc_nav = $('#what_is_afc_nav');
    meet_the_staff_nav = $('#meet_the_staff_nav');
    events_nav = $('#events_nav');
    history_nav = $('#history_nav');
    overview_nav = $('#overview_nav');
    buddy_huddle_nav = $('#buddy_huddle_nav');
    afc_11_12_nav = $('#afc_11_12_nav');
    afc_10_11_nav = $('#afc_10_11_nav');
    afc_09_10_nav = $('#afc_09_10_nav');
    AFC_1011_Staff_Button = $('#AFC_1011_Staff_Button');
    AFC_1011_Boys_Button = $('#AFC_1011_Boys_Button');
    AFC_1011_Girls_Button = $('#AFC_1011_Girls_Button');



});

$(home_nav).click(function () {


    contentcolumn.load('main_page.html');

    changeCurrentPage(home_nav);
 
});


$(committees_nav).click(function () {


    contentcolumn.load('Committees_Files/committee_info.html');

    changeCurrentPage(what_is_afc_nav);
});

$(meet_the_staff_nav).click(function () {


    contentcolumn.load('Meet_The_Staff_Files/Meet_the_Staff.html');

    changeCurrentPage(meet_the_staff_nav);
});


$(overview_nav).click(function () {

    contentcolumn.load('What_Is_AFC_Files/What_is_AFC.html');

    changeCurrentPage(what_is_afc_nav);
});

$(buddy_huddle_nav).click(function () {

    contentcolumn.load('Buddy_Huddle_Files/Buddy_Huddles.html');

    changeCurrentPage(what_is_afc_nav);
});

$(history_nav).click(function () {

    contentcolumn.load('History_Files/History.html');

    changeCurrentPage(what_is_afc_nav);
});

$(events_nav).click(function () {

    contentcolumn.load('Events_Files/Events.html');

    changeCurrentPage(what_is_afc_nav);

});

$(afc_11_12_nav).click(function () {



});

$(afc_10_11_nav).click(function () {


    contentcolumn.load('AFC_1011_Files/AFC_1011.html');

    changeCurrentPage('#ol_army_nav');

});

$(afc_09_10_nav).click(function () {



});


$(AFC_1011_Staff_Button).click(function () {

    contentcolumn.load('AFC_1011_Files/AFC_1011_Staff_Files/AFC1011_Staff.htm');

    changeCurrentPage('#ol_army_nav');


});


$(AFC_1011_Boys_Button).click(function () {

    contentcolumn.load('AFC_1011_Files/AFC_1011_Boys_Files/AFC_1011_Boys.html');

    changeCurrentPage('#ol_army_nav');


});


$(AFC_1011_Girls_Button).click(function () {

    contentcolumn.load('AFC_1011_Files/AFC_1011_Girls_Files/AFC_1011_Girls.html');

    changeCurrentPage('#ol_army_nav');


});







