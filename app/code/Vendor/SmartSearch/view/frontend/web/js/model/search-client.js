define([
    'jquery',
    'mage/storage'
], function ($, storage) {
    'use strict';
    
    return {
        /**
         * Perform a search query
         * 
         * @param {String} query The search query
         * @param {Object} options Search options
         * @returns {Promise} Promise object with search results
         */
        search: function(query, options) {
            options = options || {};
            
            return $.ajax({
                url: options.suggestUrl,
                data: {
                    q: query
                },
                type: 'GET',
                dataType: 'json'
            });
        },
        
        /**
         * Get popular searches
         * 
         * @param {Number} limit Max number of terms to return
         * @returns {Promise} Promise object with popular searches
         */
        getPopularSearches: function(limit, suggestUrl) {
            limit = limit || 5;
            
            return $.ajax({
                url: suggestUrl,
                data: {
                    q: ''
                },
                type: 'GET',
                dataType: 'json'
            }).then(function(response) {
                return response.popularSearches || [];
            });
        },
        
        /**
         * Get trending products
         * 
         * @param {Number} limit Max number of products to return
         * @returns {Promise} Promise object with trending products
         */
        getTrendingProducts: function(limit, suggestUrl) {
            limit = limit || 5;
            
            return $.ajax({
                url: suggestUrl,
                data: {
                    q: ''
                },
                type: 'GET',
                dataType: 'json'
            }).then(function(response) {
                return response.trendingProducts || [];
            });
        }
    };
});