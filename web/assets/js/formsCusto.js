// setup an "add a qst" link
var $addQstLink = $('<a href="#" class="add_qst_link">Add a question</a>');
var $newLinkLi = $('<li></li>').append($addQstLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of qsts
   var $collectionHolder = $('ul.qsts');
    // add the "add a qst" anchor and li to the qsts ul
    $collectionHolder.append($newLinkLi);
    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);
    $addQstLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        // add a new qst form (see code block below)
        addQstForm($collectionHolder, $newLinkLi);
    });


    addRemoveBtnEdit();
    
    
});

function addQstForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');
    
    // get the new index
    var index = $collectionHolder.data('index');
    
    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);
    
    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);
    
    // Display the form in the page in an li, before the "Add a qst" link li
    var $newFormLi = $('<li></li>').append(newForm);
    
    // also add a remove button, just for this example
    $newFormLi.append('<a href="#" class="remove-qst">x</a>');
    
    $newLinkLi.before($newFormLi);
    
    // handle the removal, just for this example
    $('.remove-qst').click(function(e) {
        e.preventDefault();
        
        $(this).parent().remove();
        
        return false;
    });
}

function addRemoveBtnEdit() {
    
    var $qsts = $(".qsts");
    var $qstsList = $qsts.find("textarea");
    console.log($qstsList);
    for (var i = 0; i < $qstsList.length; i= i+2) {
        //console.log(qstsList[0].parentNode);
        var $cadre = $qstsList[i].parentNode.parentNode.parentNode;

    
        $($cadre).prepend('<a href="#" class="remove-qst">x</a>');
        
        $newLinkLi.before($cadre);

    }
    // handle the removal, just for this example
    $('.remove-qst').click(function(e) {
        e.preventDefault();
        
        $(this).parent().remove();
        
        return false;
    });


}


