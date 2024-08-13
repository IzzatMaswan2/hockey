function openGroup(evt, groupName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(groupName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();


function openScheduleGroup(evt, groupName) {
    var i, scheduletabcontent, scheduletablinks;
    scheduletabcontent = document.getElementsByClassName("scheduletabcontent");
    for (i = 0; i < scheduletabcontent.length; i++) {
        scheduletabcontent[i].style.display = "none";
    }
    scheduletablinks = document.getElementsByClassName("scheduletablinks");
    for (i = 0; i < scheduletablinks.length; i++) {
        scheduletablinks[i].className = scheduletablinks[i].className.replace(" active", "");
    }
    document.getElementById(groupName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultScheduleOpen" and click on it
document.getElementById("defaultScheduleOpen").click();
