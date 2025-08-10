<!-- Trading Journal Form - Full Width -->
<div class="container">
   <div class="col-10 offset-md-1">
    <h3 class="mb-2">Trading Journal</h3>
    <p class="text-body-tertiary mb-4">Record your trading entries with detailed information</p>      <div class="row g-4 mb-4">
         <!-- Trading History Table - 2/3 width -->
         <div class="col-lg-8">
            <?php include 'components/trading-form.php'; ?>
         </div>
         <!-- Trade Performance Stats - 1/3 width -->
         <div class="col-lg-4">
            <?php include 'components/trade-strategy-checklist.php'; ?>
         </div>
      </div>
   </div>
</div>
<!-- Stats and Table Section -->
<div class="container">
   <div class="col-10 offset-md-1">
      <div class="row g-4 mb-4">
         <!-- Trading History Table - 2/3 width -->
         <div class="col-lg-9">
            <?php include 'components/trades-table.php'; ?>
         </div>
         <!-- Trade Performance Stats - 1/3 width -->
         <div class="col-lg-3">
            <?php include 'components/performance-stats.php'; ?>
         </div>
      </div>
   </div>
</div>
<!-- Edit Trade Modal -->
<div class="modal fade" id="editTradeModal" tabindex="-1">
   <div class="modal-dialog modal-xl">
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