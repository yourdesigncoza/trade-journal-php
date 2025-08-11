
<tr class="align-middle btn-reveal-trigger" data-trade-id="<?= $trade['id'] ?>">
    <td class="align-middle ps-2">
        <div><?= formatTradeDate($trade['date']) ?></div>
    </td>
    <td class="align-middle ps-2">
        <?php if (!empty($trade['time'])): ?>
            <div class="align-middle text-body-tertiary"><?= htmlspecialchars($trade['time']) ?></div>
        <?php endif; ?>
    </td>
    <td class="align-middle text-center">
        <span class="align-middle badge badge-phoenix badge-phoenix-primary"><?= htmlspecialchars($trade['market']) ?></span>
    </td>
    <td class="align-middle text-center">
        <span class="align-middle badge badge-phoenix badge-phoenix-secondary"><?= htmlspecialchars($trade['session']) ?></span>
    </td>
    <td class="align-middle text-center">
        <?= getDirectionBadge($trade['direction']) ?>
    </td>
    <td class="align-middle text-end">
        <?= $trade['entryPrice'] ? htmlspecialchars($trade['entryPrice']) : '-' ?>
    </td>
    <td class="align-middle text-end">
        <?= $trade['exitPrice'] ? htmlspecialchars($trade['exitPrice']) : '-' ?>
    </td>
    <td class="align-middle text-center">
        <?= getOutcomeBadge($trade['outcome']) ?>
    </td>
    <td class="align-middle text-center">
        <?php if ($trade['plPercent']): ?>
            <span class="align-middle <?= $trade['plPercent'] > 0 ? 'text-success' : 'text-danger' ?>">
                <?= htmlspecialchars($trade['plPercent']) ?>%
            </span>
        <?php else: ?>
            -
        <?php endif; ?>
    </td>
    <td class="align-middle text-center">
        <?= $trade['rr'] ? htmlspecialchars($trade['rr']) : '-' ?>
    </td>
    <td class="align-middle text-center">
        <?= formatTimeframes($trade['tf']) ?>
    </td>
    <td class="align-middle text-center">
        <?php if ($trade['chartHtf'] || $trade['chartLtf']): ?>
            <?php if ($trade['chartHtf']): ?>
                <a href="<?= htmlspecialchars($trade['chartHtf']) ?>" target="_blank" class="align-middle text-decoration-none me-1">
                    <span class="badge badge-phoenix badge-phoenix-primary">HTF</span>
                </a>
            <?php endif; ?>
            <?php if ($trade['chartLtf']): ?>
                <a href="<?= htmlspecialchars($trade['chartLtf']) ?>" target="_blank" class="align-middle text-decoration-none">
                    <span class="badge badge-phoenix badge-phoenix-primary">LTF</span>
                </a>
            <?php endif; ?>
        <?php else: ?>
            -
        <?php endif; ?>
    </td>
    <td class="align-middle text-center">
        <?php if ($trade['comments']): ?>
            <span class="align-middle" title="<?= htmlspecialchars($trade['comments']) ?>" data-bs-toggle="tooltip" style="cursor: help;">
                <span class="badge badge-phoenix badge-phoenix-info">Notes</span>
            </span>
        <?php else: ?>
            -
        <?php endif; ?>
    </td>
    <td class="align-middle text-center">
        <div class="align-middle dropstart position-static d-inline-block">
            <button class="align-middle btn btn-link text-body btn-sm dropdown-toggle btn-reveal" type="button" 
                    id="trade-dropdown-<?= $trade['id'] ?>" data-bs-toggle="dropdown" data-boundary="window" 
                    aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                <i class="align-middle fas fa-ellipsis fs-9"></i>
            </button>
            <div class="align-middle dropdown-menu dropdown-menu-end border py-2" aria-labelledby="trade-dropdown-<?= $trade['id'] ?>">
                <a href="#!" class="align-middle dropdown-item edit-trade" data-trade-id="<?= $trade['id'] ?>">Edit</a>
                <div class="align-middle dropdown-divider"></div>
                <a href="#!" class="align-middle dropdown-item text-danger delete-trade" data-trade-id="<?= $trade['id'] ?>">Delete</a>
            </div>
        </div>
    </td>
</tr>