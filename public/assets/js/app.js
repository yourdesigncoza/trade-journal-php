$(document).ready(function() {
    
    // Application state
    let trades = [];
    let filteredTrades = [];
    let sortConfig = { field: 'date', direction: 'desc' };
    
    // DOM elements
    const $tradingForm = $('#tradingForm');
    const $editTradeForm = $('#editTradeForm');
    const $tradesTableBody = $('#tradesTableBody');
    const $searchInput = $('#searchInput');
    const $alertContainer = $('#alertContainer');
    const $performanceStats = $('#performanceStats');
    
    // Initialize application
    init();
    
    function init() {
        setupDarkMode();
        setupFormHandlers();
        setupTableHandlers();
        loadTrades();
        setupAutoSave();
    }
    
    // =================== DARK MODE ===================
    function setupDarkMode() {
        const darkModeToggle = $('#darkModeToggle');
        const html = $('html');
        const body = $('body');
        
        // Load saved theme
        const savedTheme = localStorage.getItem('darkMode');
        if (savedTheme === 'true') {
            enableDarkMode();
        }
        
        // Toggle handler
        darkModeToggle.on('click', function() {
            if (html.attr('data-bs-theme') === 'dark') {
                disableDarkMode();
            } else {
                enableDarkMode();
            }
        });
        
        function enableDarkMode() {
            html.attr('data-bs-theme', 'dark');
            body.removeClass('bg-light').addClass('bg-dark');
            darkModeToggle.html('<i class="fas fa-sun"></i>');
            localStorage.setItem('darkMode', 'true');
        }
        
        function disableDarkMode() {
            html.attr('data-bs-theme', 'light');
            body.removeClass('bg-dark').addClass('bg-light');
            darkModeToggle.html('<i class="fas fa-moon"></i>');
            localStorage.setItem('darkMode', 'false');
        }
    }
    
    // =================== FORM HANDLING ===================
    function setupFormHandlers() {
        // Main form submission
        $tradingForm.on('submit', function(e) {
            e.preventDefault();
            submitTrade();
        });
        
        // Edit form submission
        $editTradeForm.on('submit', function(e) {
            e.preventDefault();
            updateTrade();
        });
        
        // Set today's date as default
        const today = new Date().toISOString().split('T')[0];
        $('input[name="date"]').val(today);
    }
    
    function submitTrade() {
        const $submitBtn = $('#submitBtn');
        const $submitText = $('#submitText');
        const $submitSpinner = $('#submitSpinner');
        
        // Show loading state
        $submitBtn.prop('disabled', true);
        $submitText.text('Saving...');
        $submitSpinner.removeClass('d-none');
        
        const formData = getFormData($tradingForm);
        
        $.ajax({
            url: '/api/trading-journal',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            success: function(response) {
                if (response.success) {
                    showAlert('success', 'Trade saved successfully!');
                    $tradingForm[0].reset();
                    $('input[name="date"]').val(new Date().toISOString().split('T')[0]);
                    clearDraft();
                    loadTrades();
                } else {
                    showAlert('danger', 'Error: ' + response.error);
                }
            },
            error: function() {
                showAlert('danger', 'Failed to save trade. Please try again.');
            },
            complete: function() {
                // Reset loading state
                $submitBtn.prop('disabled', false);
                $submitText.text('Save Trade Entry');
                $submitSpinner.addClass('d-none');
            }
        });
    }
    
    function updateTrade() {
        const $updateBtn = $('#updateTradeBtn');
        const $updateText = $('#updateText');
        const $updateSpinner = $('#updateSpinner');
        
        $updateBtn.prop('disabled', true);
        $updateText.text('Updating...');
        $updateSpinner.removeClass('d-none');
        
        const tradeId = $('#editId').val();
        const formData = getFormData($editTradeForm);
        
        $.ajax({
            url: `/api/trading-journal?id=${tradeId}`,
            method: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            success: function(response) {
                if (response.success) {
                    showAlert('success', 'Trade updated successfully!');
                    $('#editTradeModal').modal('hide');
                    loadTrades();
                } else {
                    showAlert('danger', 'Error: ' + response.error);
                }
            },
            error: function() {
                showAlert('danger', 'Failed to update trade. Please try again.');
            },
            complete: function() {
                $updateBtn.prop('disabled', false);
                $updateText.text('Update Trade');
                $updateSpinner.addClass('d-none');
            }
        });
    }
    
    function getFormData($form) {
        const formData = {};
        const formArray = $form.serializeArray();
        
        // Handle regular fields
        formArray.forEach(function(item) {
            if (item.name === 'tf[]') {
                if (!formData.tf) formData.tf = [];
                formData.tf.push(item.value);
            } else {
                formData[item.name] = item.value || null;
            }
        });
        
        // Handle checkboxes for tf
        if (!formData.tf) {
            const checkedTf = $form.find('input[name="tf[]"]:checked').map(function() {
                return this.value;
            }).get();
            if (checkedTf.length > 0) {
                formData.tf = checkedTf;
            }
        }
        
        return formData;
    }
    
    // =================== TABLE HANDLING ===================
    function setupTableHandlers() {
        // Search functionality
        $searchInput.on('input', debounce(function() {
            filterTrades();
        }, 300));
        
        // Refresh button
        $('#refreshTable').on('click', function() {
            loadTrades();
        });
        
        // Sort functionality
        $(document).on('click', '.sortable', function() {
            const field = $(this).data('sort');
            
            if (sortConfig.field === field) {
                sortConfig.direction = sortConfig.direction === 'asc' ? 'desc' : 'asc';
            } else {
                sortConfig.field = field;
                sortConfig.direction = 'asc';
            }
            
            updateSortIcons();
            sortAndRenderTrades();
        });
        
        // Edit and Delete handlers
        $(document).on('click', '.edit-trade', function() {
            const tradeId = $(this).data('trade-id');
            editTrade(tradeId);
        });
        
        $(document).on('click', '.delete-trade', function() {
            const tradeId = $(this).data('trade-id');
            deleteTrade(tradeId);
        });
        
        // Delete confirmation
        $('#confirmDelete').on('click', function() {
            const tradeId = $(this).data('trade-id');
            performDelete(tradeId);
        });
    }
    
    function loadTrades() {
        $tradesTableBody.html(`
            <tr>
                <td colspan="13" class="text-center py-4">
                    <div class="spinner-border text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 text-muted mb-0">Loading trades...</p>
                </td>
            </tr>
        `);
        
        $.ajax({
            url: '/api/trading-journal',
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    trades = response.entries || [];
                    filterTrades();
                    updatePerformanceStats();
                } else {
                    showAlert('danger', 'Failed to load trades: ' + response.error);
                }
            },
            error: function() {
                showAlert('danger', 'Failed to load trades. Please try again.');
                renderEmptyState();
            }
        });
    }
    
    function filterTrades() {
        const searchTerm = $searchInput.val().toLowerCase();
        
        if (!searchTerm) {
            filteredTrades = [...trades];
        } else {
            filteredTrades = trades.filter(trade => 
                Object.values(trade).some(value => 
                    value && value.toString().toLowerCase().includes(searchTerm)
                )
            );
        }
        
        sortAndRenderTrades();
        updatePerformanceStats();
    }
    
    function sortAndRenderTrades() {
        const sorted = [...filteredTrades].sort((a, b) => {
            let aVal = a[sortConfig.field];
            let bVal = b[sortConfig.field];
            
            // Handle null values
            if (aVal === null || aVal === undefined) aVal = '';
            if (bVal === null || bVal === undefined) bVal = '';
            
            // Convert to comparable values
            if (typeof aVal === 'string') aVal = aVal.toLowerCase();
            if (typeof bVal === 'string') bVal = bVal.toLowerCase();
            
            if (sortConfig.direction === 'asc') {
                return aVal > bVal ? 1 : -1;
            } else {
                return aVal < bVal ? 1 : -1;
            }
        });
        
        renderTrades(sorted);
    }
    
    function renderTrades(tradesToRender) {
        if (tradesToRender.length === 0) {
            renderEmptyState();
            return;
        }
        
        let html = '';
        tradesToRender.forEach(trade => {
            html += generateTradeRow(trade);
        });
        
        $tradesTableBody.html(html);
        
        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
    }
    
    function generateTradeRow(trade) {
        const outcomeClass = {
            'W': 'bg-success',
            'L': 'bg-danger', 
            'BE': 'bg-warning',
            'C': 'bg-secondary'
        };
        
        const directionClass = trade.direction === 'LONG' ? 'bg-success' : 'bg-danger';
        const plClass = trade.plPercent > 0 ? 'text-success' : 'text-danger';
        
        return `
            <tr data-trade-id="${trade.id}">
                <td>
                    <small>${formatDate(trade.date)}</small><br>
                    <small class="text-muted">${trade.time || ''}</small>
                </td>
                <td><span class="badge bg-primary">${trade.market}</span></td>
                <td><span class="badge bg-secondary">${trade.session}</span></td>
                <td>
                    ${trade.direction ? `<span class="badge ${directionClass}">${trade.direction}</span>` : '-'}
                </td>
                <td>${trade.entryPrice || '-'}</td>
                <td>${trade.exitPrice || '-'}</td>
                <td>
                    ${trade.outcome ? `<span class="badge ${outcomeClass[trade.outcome]}">${trade.outcome}</span>` : '-'}
                </td>
                <td>
                    ${trade.plPercent ? `<span class="${plClass}">${trade.plPercent}%</span>` : '-'}
                </td>
                <td>${trade.rr || '-'}</td>
                <td>
                    ${trade.tf ? trade.tf.map(tf => `<span class="badge bg-info me-1">${tf}</span>`).join('') : '-'}
                </td>
                <td>
                    ${trade.chartHtf ? `<a href="${trade.chartHtf}" target="_blank" class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-chart-line"></i></a>` : ''}
                    ${trade.chartLtf ? `<a href="${trade.chartLtf}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fas fa-chart-area"></i></a>` : ''}
                    ${!trade.chartHtf && !trade.chartLtf ? '-' : ''}
                </td>
                <td>
                    ${trade.comments ? `<button class="btn btn-sm btn-outline-info" title="${escapeHtml(trade.comments)}" data-bs-toggle="tooltip"><i class="fas fa-comment"></i></button>` : '-'}
                </td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary edit-trade" data-trade-id="${trade.id}" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-outline-danger delete-trade" data-trade-id="${trade.id}" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    }
    
    function renderEmptyState() {
        $tradesTableBody.html(`
            <tr>
                <td colspan="13" class="text-center py-5">
                    <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No trades found</h5>
                    <p class="text-muted mb-0">Start by adding your first trade entry above.</p>
                </td>
            </tr>
        `);
    }
    
    function updateSortIcons() {
        $('.sortable i').removeClass('fa-sort-up fa-sort-down').addClass('fa-sort');
        
        const $currentHeader = $(`.sortable[data-sort="${sortConfig.field}"] i`);
        $currentHeader.removeClass('fa-sort');
        
        if (sortConfig.direction === 'asc') {
            $currentHeader.addClass('fa-sort-up');
        } else {
            $currentHeader.addClass('fa-sort-down');
        }
    }
    
    // =================== EDIT/DELETE OPERATIONS ===================
    function editTrade(tradeId) {
        const trade = trades.find(t => t.id === tradeId);
        if (!trade) return;
        
        // Populate edit form
        $('#editId').val(trade.id);
        $('#editMarket').val(trade.market);
        $('#editSession').val(trade.session);
        $('#editDate').val(trade.date);
        $('#editTime').val(trade.time || '');
        $('#editDirection').val(trade.direction);
        $('#editEntryPrice').val(trade.entryPrice || '');
        $('#editExitPrice').val(trade.exitPrice || '');
        $('#editOutcome').val(trade.outcome || '');
        $('#editPlPercent').val(trade.plPercent || '');
        $('#editRR').val(trade.rr || '');
        $('#editChartHtf').val(trade.chartHtf || '');
        $('#editChartLtf').val(trade.chartLtf || '');
        $('#editComments').val(trade.comments || '');
        
        // Handle timeframes checkboxes
        $('input[name="tf[]"]', $editTradeForm).prop('checked', false);
        if (trade.tf) {
            trade.tf.forEach(tf => {
                $(`#editTf${tf.toLowerCase()}`, $editTradeForm).prop('checked', true);
            });
        }
        
        $('#editTradeModal').modal('show');
    }
    
    function deleteTrade(tradeId) {
        $('#confirmDelete').data('trade-id', tradeId);
        $('#deleteModal').modal('show');
    }
    
    function performDelete(tradeId) {
        $.ajax({
            url: `/api/trading-journal?id=${tradeId}`,
            method: 'DELETE',
            success: function(response) {
                if (response.success) {
                    showAlert('success', 'Trade deleted successfully!');
                    $('#deleteModal').modal('hide');
                    loadTrades();
                } else {
                    showAlert('danger', 'Error: ' + response.error);
                }
            },
            error: function() {
                showAlert('danger', 'Failed to delete trade. Please try again.');
            }
        });
    }
    
    // =================== PERFORMANCE STATS ===================
    function updatePerformanceStats() {
        const stats = calculateStats(filteredTrades);
        renderPerformanceStats(stats);
    }
    
    function calculateStats(tradesData) {
        const totalTrades = tradesData.length;
        
        if (totalTrades === 0) {
            return {
                totalTrades: 0,
                winRate: 0,
                totalWins: 0,
                totalLosses: 0,
                totalBE: 0,
                totalCancelled: 0,
                accountGain: 0,
                profitFactor: 0,
                avgRR: 0,
                avgPL: 0,
                bestTrade: 0,
                worstTrade: 0
            };
        }
        
        const wins = tradesData.filter(t => t.outcome === 'W');
        const losses = tradesData.filter(t => t.outcome === 'L');
        const breakEvens = tradesData.filter(t => t.outcome === 'BE');
        const cancelled = tradesData.filter(t => t.outcome === 'C');
        
        const winRate = totalTrades > 0 ? (wins.length / totalTrades * 100) : 0;
        
        const plValues = tradesData.filter(t => t.plPercent !== null && t.plPercent !== undefined).map(t => t.plPercent);
        const totalPL = plValues.reduce((sum, pl) => sum + pl, 0);
        const avgPL = plValues.length > 0 ? totalPL / plValues.length : 0;
        
        const winPL = wins.filter(t => t.plPercent).reduce((sum, t) => sum + t.plPercent, 0);
        const lossPL = Math.abs(losses.filter(t => t.plPercent).reduce((sum, t) => sum + t.plPercent, 0));
        const profitFactor = lossPL > 0 ? winPL / lossPL : 0;
        
        const rrValues = tradesData.filter(t => t.rr !== null && t.rr !== undefined).map(t => t.rr);
        const avgRR = rrValues.length > 0 ? rrValues.reduce((sum, rr) => sum + rr, 0) / rrValues.length : 0;
        
        const bestTrade = plValues.length > 0 ? Math.max(...plValues) : 0;
        const worstTrade = plValues.length > 0 ? Math.min(...plValues) : 0;
        
        return {
            totalTrades,
            winRate: Math.round(winRate * 100) / 100,
            totalWins: wins.length,
            totalLosses: losses.length,
            totalBE: breakEvens.length,
            totalCancelled: cancelled.length,
            accountGain: Math.round(totalPL * 100) / 100,
            profitFactor: Math.round(profitFactor * 100) / 100,
            avgRR: Math.round(avgRR * 100) / 100,
            avgPL: Math.round(avgPL * 100) / 100,
            bestTrade: Math.round(bestTrade * 100) / 100,
            worstTrade: Math.round(worstTrade * 100) / 100
        };
    }
    
    function renderPerformanceStats(stats) {
        const template = $('#performanceTemplate').html();
        $performanceStats.html(template);
        
        // Update values
        $('#totalTrades').text(stats.totalTrades);
        $('#winRate').text(stats.winRate + '%');
        $('#totalWins').text(stats.totalWins);
        $('#totalLosses').text(stats.totalLosses);
        $('#totalBE').text(stats.totalBE);
        $('#totalCancelled').text(stats.totalCancelled);
        $('#accountGain').text(stats.accountGain + '%');
        $('#profitFactor').text(stats.profitFactor);
        $('#avgRR').text(stats.avgRR);
        $('#avgPL').text(stats.avgPL + '%');
        $('#bestTrade').text(stats.bestTrade + '%');
        $('#worstTrade').text(stats.worstTrade + '%');
    }
    
    // =================== AUTO-SAVE FUNCTIONALITY ===================
    function setupAutoSave() {
        const STORAGE_KEY = 'trading-journal-draft';
        
        // Load draft on page load
        loadDraft();
        
        // Auto-save every 10 seconds
        setInterval(saveDraft, 10000);
        
        // Save on form change
        $tradingForm.on('change input', debounce(saveDraft, 1000));
        
        function saveDraft() {
            const formData = getFormData($tradingForm);
            
            // Don't save empty forms
            if (Object.values(formData).every(val => !val || (Array.isArray(val) && val.length === 0))) {
                return;
            }
            
            localStorage.setItem(STORAGE_KEY, JSON.stringify(formData));
        }
        
        function loadDraft() {
            const draft = localStorage.getItem(STORAGE_KEY);
            if (!draft) return;
            
            try {
                const data = JSON.parse(draft);
                
                // Populate form fields
                Object.keys(data).forEach(key => {
                    if (key === 'tf' && Array.isArray(data[key])) {
                        data[key].forEach(tf => {
                            $(`input[name="tf[]"][value="${tf}"]`).prop('checked', true);
                        });
                    } else if (data[key]) {
                        $(`[name="${key}"]`).val(data[key]);
                    }
                });
                
            } catch (e) {
                console.error('Failed to load draft:', e);
            }
        }
        
        function clearDraft() {
            localStorage.removeItem(STORAGE_KEY);
        }
        
        // Expose clearDraft function
        window.clearDraft = clearDraft;
    }
    
    // =================== UTILITY FUNCTIONS ===================
    function showAlert(type, message) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        $alertContainer.html(alertHtml);
        
        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            $('.alert', $alertContainer).alert('close');
        }, 5000);
    }
    
    function debounce(func, delay) {
        let timeoutId;
        return function (...args) {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => func.apply(this, args), delay);
        };
    }
    
    function formatDate(dateString) {
        if (!dateString) return '';
        const date = new Date(dateString);
        return date.toLocaleDateString();
    }
    
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }
});