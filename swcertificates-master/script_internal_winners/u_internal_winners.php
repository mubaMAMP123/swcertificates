<!-- Internal Winner input modal start -->
<div class="modal fade" id="internal_winner_input_form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="internal_winner_input_form_heading" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="internal_winner_input_form_heading">Add Internal Winner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="script_internal_winners/add_internal_winner?eid=<?= $event_id ?>" method="post">
                    <div class="mb-3">
                        <label for="internal_winner_regno" class="form-label">Registration No.</label>
                        <input type="text" class="form-control capitalize" id="internal_winner_regno" name="internal_winner_regno" placeholder="Enter Registration No." pattern="[0-9]{2}[A-Z]{3}[0-9]{4}" title="Example: 17BCE0463" required>
                    </div>
                    <div class="mb-3">
                        <label for="internal_winner_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="internal_winner_name" name="internal_winner_name" placeholder="Enter name" required>
                    </div>
                    <label for="internal_winner_email" class="form-label">VIT Mail ID</label>
                    <div class="mb-3 input-group">
                        <input type="text" class="form-control lowercase" id="internal_winner_email" name="internal_winner_email" aria-describedby="internal_winner_email" placeholder="Enter username" pattern="[a-z]+\.+([a-z]*)+[0-9]{4}" title="Example: ali.muhammed2017 or ali.2017" required>
                        <span class="input-group-text" id="internal_winner_email">@vitstudent.ac.in</span>
                    </div>
                    <div class="mb-3">
                        <label for="internal_winner_position" class="form-label">Position</label>
                        <select class="form-select" name="internal_winner_position" id="internal_winner_position" required>
                            <option disabled selected value> -- select a position -- </option>
                            <option value="1">First</option>
                            <option value="2">Second</option>
                            <option value="3">Third</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="internal_winner_submit">Add Winner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Internal Winner input modal end -->

<div class="card mb-5 shadow">
    <div class="card-header text-center fs-5 bg-3 text-white">Internal Winner Certificates</div>
    <div class="card-body">
        <div class="text-center">
            <!-- add winner button -->
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#internal_winner_input_form"><i class="fa fa-plus" aria-hidden="true"></i> Add Winner</button>
            <?php
            if (count($data_internal_winners) > 0) :
                // show request all button
                if ($internal_winner_request_all_btn) :
            ?>
                    <a href="script_internal_winners/requestAllInternalWinners?eid=<?= $entry_internal_winner['event_id']; ?>">
                        <button type="button" class="btn btn-warning me-2 loading_btn"><i class="fa fa-fast-forward" aria-hidden="true"></i> Request All</button>
                    </a>
                <?php
                endif;
                // show generate all button
                if ($internal_winner_generate_all_btn) :
                ?>
                    <a href="script_internal_winners/generateAllInternalWinners?eid=<?= $entry_internal_winner['event_id']; ?>">
                        <button type="button" class="btn btn-success me-2 generate_btn"><i aria-hidden="true" class="fa fa-cogs"></i> Generate All</button>
                    </a>
                <?php
                endif;
                // show download all & send mail buttons
                if ($internal_winner_download_all_btn) :
                ?>
                    <a href="script_internal_winners/downloadAllInternalWinners?eid=<?= $entry_internal_winner['event_id']; ?>">
                        <button type="button" class="btn btn-dark me-2"><i aria-hidden="true" class="fa fa-download"></i> Download All</button>
                    </a>
                    <a href="script_internal_winners/pdfReport?eid=<?= $entry_internal_winner['event_id']; ?>">
                        <button type="button" class="btn btn-success me-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generate Report</button>
                    </a>
                    <a href="script_internal_winners/sendMailAllInternalWinners?eid=<?= $entry_internal_winner['event_id']; ?>&uid=u">
                        <button type="button" class="btn btn-warning me-2 send_mail_btn"><i aria-hidden="true" class="fa fa-paper-plane"></i> Sent Mail</button>
                    </a>
                <?php
                endif;
                ?>
                <!-- show delete all button -->
                <a href="script_internal_winners/deleteAllInternalWinners?eid=<?= $entry_internal_winner['event_id']; ?>&uid=u" class="btn-del-all-internal-winners">
                    <button type="button" class="btn btn-danger me-2"><i aria-hidden="true" class="fa fa-trash"></i> Delete All</button>
                </a>
            <?php endif; ?>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-hover table-bordered text-center">
                <thead class="table-dark">
                    <tr class="align-middle">
                        <th></th>
                        <th>Registration No.</th>
                        <th>Name</th>
                        <th>VIT Mail ID</th>
                        <th>Position</th>
                        <th>Certificate No.</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($data_internal_winners) > 0) :
                        // numbering the entries
                        $count = 1;
                        foreach ($data_internal_winners as $entry_internal_winner) :
                    ?>
                            <tr class="align-middle">
                                <td><?= $count; ?></td>
                                <td><?= $entry_internal_winner['entry_regno']; ?></td>
                                <td><?= $entry_internal_winner['entry_name']; ?></td>
                                <td><?= $entry_internal_winner['entry_email']; ?></td>
                                <td>
                                    <?php
                                    if ($entry_internal_winner['entry_position'] == 1) {
                                        echo "First";
                                    } elseif ($entry_internal_winner['entry_position'] == 2) {
                                        echo "Second";
                                    } elseif ($entry_internal_winner['entry_position'] == 3) {
                                        echo "Third";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($entry_internal_winner['certificate_number'] == "") :
                                        echo "Not available";
                                    else :
                                        echo $entry_internal_winner['certificate_number'];
                                    endif;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // show status
                                    if ($entry_internal_winner['request_status'] == 0 && $entry_internal_winner['approval_status'] == 0 && $entry_internal_winner['generate_status'] == 0) {
                                        echo "<span class='text-warning'>Request not raised</span>";
                                    } elseif ($entry_internal_winner['request_status'] == 1 && $entry_internal_winner['approval_status'] == 0 && $entry_internal_winner['generate_status'] == 0) {
                                        echo "<span class='text-primary'>Requested by " . $entry_internal_winner['requested_by'] . " on " . $entry_internal_winner['requested_at'] . "</span><br><span class='text-secondary'>Pending Approval</span>";
                                    } elseif ($entry_internal_winner['request_status'] == 1 && $entry_internal_winner['approval_status'] == 1 && $entry_internal_winner['generate_status'] == 0) {
                                        echo "<span class='text-success'>Approved by " . $entry_internal_winner['approved_by'] . " on " . $entry_internal_winner['approved_at'] . "</span><br><span class='text-danger'>Certificate not generated</span>";
                                    } elseif ($entry_internal_winner['request_status'] == 1 && $entry_internal_winner['approval_status'] == 2 && $entry_internal_winner['generate_status'] == 0) {
                                        echo "<span class='text-danger'>Requested by " . $entry_internal_winner['requested_by'] . " on " . $entry_internal_winner['requested_at'] . "<br>Rejected by " . $entry_internal_winner['approved_by'] . " on " . $entry_internal_winner['approved_at'] . "</span>";
                                    } elseif ($entry_internal_winner['request_status'] == 1 && $entry_internal_winner['approval_status'] == 1 && $entry_internal_winner['generate_status'] == 1 && $entry_internal_winner['mail_status'] == 0) {
                                        echo "<span class='text-success'>Approved by " . $entry_internal_winner['approved_by'] . " on " . $entry_internal_winner['approved_at'] . "<br>Certificate generated by " . $entry_internal_winner['generated_by'] . " on " . $entry_internal_winner['generated_at'] . "</span>";
                                    } elseif ($entry_internal_winner['request_status'] == 1 && $entry_internal_winner['approval_status'] == 1 && $entry_internal_winner['generate_status'] == 1 && $entry_internal_winner['mail_status'] == 1) {
                                        echo "<span class='text-success'>Approved by " . $entry_internal_winner['approved_by'] . " on " . $entry_internal_winner['approved_at'] . "<br>Certificate generated by " . $entry_internal_winner['generated_by'] . " on " . $entry_internal_winner['generated_at'] . "<br>Mail sent by " . $entry_internal_winner['mailed_by'] . " on " . $entry_internal_winner['mailed_at'] . "</span>";
                                    } elseif ($entry_internal_winner['request_status'] == 1 && $entry_internal_winner['approval_status'] == 1 && $entry_internal_winner['generate_status'] == 1 && $entry_internal_winner['mail_status'] == 2) {
                                        echo "<span class='text-success'>Approved by " . $entry_internal_winner['approved_by'] . " on " . $entry_internal_winner['approved_at'] . "<br>Certificate generated by " . $entry_internal_winner['generated_by'] . " on " . $entry_internal_winner['generated_at'] . "</span><br><span class='text-danger'>Error in sending mail</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <!-- show request button -->
                                    <?php if ($entry_internal_winner['request_status'] == 0) : ?>
                                        <a href="script_internal_winners/requestSingleInternalWinner?iwid=<?= $entry_internal_winner['entry_id']; ?>&eid=<?= $entry_internal_winner['event_id']; ?>">
                                            <button type="button" class="btn btn-sm btn-warning me-2 mt-2 loading_btn"><i class="fa fa-forward" aria-hidden="true"></i> Request</button>
                                        </a>
                                    <?php endif;
                                    // show generate button
                                    if ($entry_internal_winner['approval_status'] == 1 && $entry_internal_winner['generate_status'] == 0) : ?>
                                        <a href="script_internal_winners/generateSingleInternalWinner?iwid=<?= $entry_internal_winner['entry_id']; ?>&eid=<?= $entry_internal_winner['event_id']; ?>">
                                            <button type="button" class="btn btn-sm btn-success me-2 mt-2 generate_btn"><i class="fa fa-cog" aria-hidden="true"></i> Generate</button>
                                        </a>
                                    <?php endif;
                                    // show download and send mail buttons
                                    if ($entry_internal_winner['generate_status'] == 1) : ?>
                                        <a href="certificates/<?php echo $event_id; ?>/internal_winners/<?php echo $entry_internal_winner['entry_regno']; ?>.jpg" download>
                                            <button type="button" class="btn btn-sm btn-dark me-2 mt-2"><i aria-hidden="true" class="fa fa-download"></i> Download</button>
                                        </a>
                                        <a href="script_internal_winners/sendMailSingleInternalWinner?iwid=<?= $entry_internal_winner['entry_id']; ?>&eid=<?= $entry_internal_winner['event_id']; ?>&uid=u">
                                            <button type="button" class="btn btn-sm btn-warning me-2 mt-2 send_mail_btn"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Mail</button>
                                        </a>
                                    <?php endif; ?>
                                    <!-- show delete button -->
                                    <a href="script_internal_winners/deleteSingleInternalWinner?iwid=<?= $entry_internal_winner['entry_id']; ?>&eid=<?= $entry_internal_winner['event_id']; ?>&uid=u" class="btn-del-single-internal-winner">
                                        <button type="button" class="btn btn-sm btn-danger me-2 mt-2"><i aria-hidden="true" class="fa fa-trash"></i> Delete</button>
                                    </a>
                                </td>
                            </tr>
                        <?php
                            // incrementing the count by 1
                            $count++;
                        endforeach;
                    else :
                        ?>
                        <!-- show no data available -->
                        <tr class="align-middle">
                            <td colspan="8">No Data Available</td>
                        </tr>
                    <?php
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>