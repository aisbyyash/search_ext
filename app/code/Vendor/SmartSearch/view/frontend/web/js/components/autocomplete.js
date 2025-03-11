define([
    'jquery',
    'ko',
    'underscore',
    'uiComponent',
    'mage/translate'
], function ($, ko, _, Component, $t) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Vendor_SmartSearch/template/autocomplete',
            searchFieldSelector: '#search',
            minQueryLength: 2,
            debounceTime: 300,
            displayThumbnails: true,
            displayPrice: true,
            displayDescription: true,
            showPopularSearches: true,
            showCategoryResults: true,
            maxResults: 10,
            maxCategoryResults: 3,
            maxPopularSearches: 5,
            suggestUrl: ''
        },

        searchQuery: ko.observable(''),
        isLoading: ko.observable(false),
        activeResults: ko.observable(false),
        productResults: ko.observableArray([]),
        categoryResults: ko.observableArray([]),
        cmsResults: ko.observableArray([]),
        popularSearches: ko.observableArray([]),
        trendingProducts: ko.observableArray([]),
        debounceTimer: null,
        hasResults: ko.computed(function() {
            return this.productResults().length > 0 || 
                   this.categoryResults().length > 0 || 
                   this.cmsResults().length > 0;
        }, this),

        initialize: function () {
            this._super();
            
            // Load initial popular searches
            if (this.showPopularSearches) {
                this._loadPopularSearches();
            }
            
            // Setup search field handlers
            this._initSearchField();
            
            return this;
        },

        _initSearchField: function () {
            var self = this;
            var searchField = $(this.searchFieldSelector);
            
            // Bind to the input field
            searchField.on('keyup', function (e) {
                // Escape key
                if (e.keyCode === 27) {
                    self.closeResults();
                    return;
                }
                
                var query = $(this).val().trim();
                self.searchQuery(query);
                
                // Clear previous timeout
                clearTimeout(self.debounceTimer);
                
                if (query.length >= self.minQueryLength) {
                    self.debounceTimer = setTimeout(function() {
                        self.performSearch(query);
                    }, self.debounceTime);
                } else {
                    self.activeResults(query.length > 0 && self.showPopularSearches);
                    self.productResults([]);
                    self.categoryResults([]);
                    self.cmsResults([]);
                }
            });
            
            // Handle focus on search field
            searchField.on('focus', function() {
                console.log("Getting here");
                var query = self.searchQuery();
                if (query.length > 0 || self.showPopularSearches) {
                    self.activeResults(true);
                }
            });
            
            // Handle clicks outside search field
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.search-autocomplete, ' + self.searchFieldSelector).length) {
                    self.closeResults();
                }
            });
        },
        
        performSearch: function(query) {
            var self = this;
            
            this.isLoading(true);
            this.activeResults(true);
            
            // Call search API
            $.ajax({
                url: this.suggestUrl,
                data: {
                    q: query
                },
                type: 'GET',
                dataType: 'json'
            }).done(function(response) {
                // Set results
                self.productResults(response.products || []);
                self.categoryResults(response.categories || []);
                self.cmsResults(response.cms || []);
                
                if (response.popularSearches) {
                    self.popularSearches(response.popularSearches);
                }
                
                self.isLoading(false);
            }).fail(function(error) {
                console.error('Search error:', error);
                self.isLoading(false);
            });
        },
        
        _loadPopularSearches: function() {
            var self = this;
            
            // For now we'll load a static list, but this could be an API call
            $.ajax({
                url: this.suggestUrl,
                data: {
                    q: ''
                },
                type: 'GET',
                dataType: 'json'
            }).done(function(response) {
                if (response.popularSearches) {
                    self.popularSearches(response.popularSearches);
                }
            });
        },
        
        selectSearchTerm: function(term) {
            $(this.searchFieldSelector).val(term).focus();
            this.searchQuery(term);
            this.performSearch(term);
        },
        
        goToProductUrl: function(url) {
            window.location.href = url;
        },
        
        goToCategoryUrl: function(url) {
            window.location.href = url;
        },
        
        goToCmsUrl: function(url) {
            window.location.href = url;
        },
        
        closeResults: function() {
            this.activeResults(false);
        }
    });
});