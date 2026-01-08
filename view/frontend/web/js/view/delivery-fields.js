define([
  'uiComponent',
  'Magento_Checkout/js/model/quote'
], function (Component, quote) {
  'use strict';

  return Component.extend({
    defaults: {
      template: 'Octocub_OneStepCheckout/delivery-fields'
    },

    initObservable: function () {
      this._super();
      this.deliveryDate = '';
      this.deliveryTime = '';
      return this;
    },

    setDate: function (val) {
      this.deliveryDate = val;
      this._persist();
    },

    setTime: function (val) {
      this.deliveryTime = val;
      this._persist();
    },

    _persist: function () {
      var address = quote.shippingAddress();
      if (!address) return;

      address['extension_attributes'] = address['extension_attributes'] || {};
      address['extension_attributes']['octocub_delivery_date'] = this.deliveryDate;
      address['extension_attributes']['octocub_delivery_time'] = this.deliveryTime;
    }
  });
});
