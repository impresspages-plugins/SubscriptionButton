/**
 * @package ImpressPages
 *
 */

var IpWidget_SubscriptionButton = function () {
    "use strict";
    this.widgetObject = null;
    this.confirmButton = null;
    this.data = {};

    this.init = function (widgetObject, data) {

        this.widgetObject = widgetObject;
        this.data = data;

        var container = this.widgetObject.find('.ipsContainer');


        var context = this; // set this so $.proxy would work below


        this.$widgetOverlay = $('<div></div>');
        this.widgetObject.prepend(this.$widgetOverlay);
        this.$widgetOverlay.on('click', $.proxy(openPopup, this));

        $(document).on('ipWidgetResized', function () {
            $.proxy(fixOverlay, context)();
        });
        $(window).on('resize', function () {
            $.proxy(fixOverlay, context)();
        });
        $.proxy(fixOverlay, context)();


        ipInitForms();

        container.css('min-height', '30px');
    };


    var fixOverlay = function () {
        this.$widgetOverlay
            .css('position', 'absolute')
            .css('z-index', 1000) // should be higher enough but lower than widget controls
            .width(this.widgetObject.width())
            .height(this.widgetObject.height());
    };


    this.onAdd = function () {
        $.proxy(openPopup, this)();
    };

    var openPopup = function () {
        var context = this;
        $('#ipWidgetSubscriptionButtonPopup').remove(); //remove any existing popup.

        var data = {
            aa: 'SubscriptionButton.widgetPopupForm',
            securityToken: ip.securityToken,
            widgetId: this.widgetObject.data('widgetid')
        }

        $.ajax({
            url: ip.baseUrl,
            data: data,
            dataType: 'json',
            type: 'GET',
            success: function (response) {
                //create new popup
                var $popupHtml = $(response.popup);
                $('body').append($popupHtml);
                var $popup = $('#ipWidgetSubscriptionButtonPopup .ipsModal');
                $popup.modal();
                ipInitForms();
                $popup.find('.ipsConfirm').on('click', function (e) {e.preventDefault(); $popup.find('form').submit();});
                $popup.find('form').off('submit').on('submit', function (e) {e.preventDefault(); $.proxy(save, context)();});


            },
            error: function (response) {
                alert('Error: ' + response.responseText);
            }

        });



    };



    var save = function () {
        var formData = $('#ipWidgetSubscriptionButtonPopup form').serializeArray();
        var data = {};
        $.each(formData, function (key, value) {
            if ($.inArray(value.name, ['antispam[]', 'securityToken']) === -1) {
                data[value.name] = value.value;
            }
        });

        this.widgetObject.save(data, 1); // save and reload widget
        var $popup = $('#ipWidgetSubscriptionButtonPopup .ipsModal');
        $popup.modal('hide');
    };

};

