var liveTickAdm = (function($) {
    return {
        editpage: function()
        {
            //If activeTicker is set, make sure the <select> shows it
            if(localStorage.getItem('activeTicker')
                && localStorage.getItem('activeTicker') !== "null"){
                $('select[name="active_ticker"]')
                .val(localStorage.getItem('activeTicker'));
            }

            //If there is only one <option> in the select, set it as active
            if ($('select[name="active_ticker"]').children().length < 2) {
                this.updateStorageWithTickerEvent($('select[name="active_ticker"]').val())
            }
            //If the <select> changes, update activeTicker
            $('select[name="active_ticker"]')
                .on('change', this.updateStorageWithTickerEvent)
                .bind(this)
        },

        updateStorageWithTickerEvent: function(e, id)
        {
            if (typeof id === "undefined") {
                id = $(this).val()
            }
            localStorage.setItem('activeTicker', id);
        },

        postpage: function()
        {
            if (localStorage.getItem('activeTicker')
                && localStorage.getItem('activeTicker') !== "null") {
                $('#in-tickevents-'+localStorage.getItem('activeTicker'))
                .prop('checked', true)
            }
        }
    }
})(jQuery)

jQuery('document').ready(function(){
    if (adminpage === "post-new-php" && pagenow === "livetick") {
        liveTickAdm.postpage()
    } else {
        liveTickAdm.editpage()
    }
});
