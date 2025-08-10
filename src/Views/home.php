<div class="container-fluid">
    
    <!-- Top Section: Form and Stats Side by Side -->
    <div class="row g-4 mb-4">
        <!-- Trading Journal Form - 2/3 width -->
        <div class="col-lg-8">
            <?php include 'components/trading-form.php'; ?>
        </div>
        
        <!-- Trade Performance Stats - 1/3 width -->
        <div class="col-lg-4">
            <?php include 'components/performance-stats.php'; ?>
        </div>
    </div>
    
    <!-- Bottom Section: Trading History Table -->
    <div class="row">
        <div class="col-12">
            <?php include 'components/trades-table.php'; ?>
        </div>
    </div>
    
</div>

<!-- Edit Trade Modal -->
<div class="modal fade" id="editTradeModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Trade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?php include 'components/edit-form.php'; ?>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this trade entry? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>