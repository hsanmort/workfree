// setup an "add a prop" link
var $addPropLinkExp = $('<hr><a href="#" class="add_prop_link_exp btn-u">Add an Experience</a>');
var $newLinkLiExp = $('<li></li>').append($addPropLinkExp);

jQuery(document).ready(function() {

    // Get the ul that holds the collection of props
   var $collectionHolder = $('ul.exps');
    // add the "add a prop" anchor and li to the props ul
    $collectionHolder.append($newLinkLiExp);
    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)

    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addPropLinkExp.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        // add a new prop form (see code block below)
        addpropForm($collectionHolder, $newLinkLiExp);

        addIds();
    });

    var $props = $(".exps");
    addRemoveBtnEdit($props);
    addIds();

    
    
    
});

function addpropForm($collectionHolder, $newLinkLiExp) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');
    
    // get the new index
    var index = $collectionHolder.data('index');

    //////////////////////////

    var $collection_old = $('.props_radio_div');
    index += $collection_old.length;
    console.log(index);

    //////////////////////////
    
    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);
    
    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    //$divCorrect = "<div class='props_radio_div btn-u'><input type='radio' class='props_radio' name='reponse_props' value='1'>Correct</input></div>";
    
    // Display the form in the page in an li, before the "Add a prop" link li
    var $newFormLi = $('<li></li>').append(newForm);
    
    // also add a remove button, just for this example
    $newFormLi.prepend('<a href="#" class="remove-prop btn-u">x</a>');
    
    $newLinkLiExp.before($newFormLi);
    // handle the removal, just for this example
    $('.remove-prop').click(function(e) {
        e.preventDefault();
        
        $(this).parent().remove();
        addIds();
        return false;
    });
}

function addRemoveBtnEdit($props) {
    
    
    var $propsList = $props.find("textarea");
    console.log($propsList);
    for (var i = 0; i < $propsList.length; i++) {
        //console.log(propsList[0].parentNode);
        var $cadre = $propsList[i].parentNode;

    
        $($cadre).prepend("<a href='#' class='remove-prop btn-u'>x</a><br>");
        
        $newLinkLiExp.before($cadre);

    }
    // handle the removal, just for this example
    $('.remove-prop').click(function(e) {
        e.preventDefault();
        
        $(this).parent().remove();
        addIds();
        
        return false;
    });


}

function addIds() {
    radios = document.getElementsByClassName("props_radio");
    for (var i = 0; i < radios.length; i++) {
        radios[i].value = i+1;
        //console.log(radios[i].value);
    }
}
