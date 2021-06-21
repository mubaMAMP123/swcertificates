<!-- External Winner input modal start -->
<div class="modal fade" id="external_winner_input_form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="external_winner_input_form_heading" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="external_winner_input_form_heading">Add External Winner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="script_external_winners/add_external_winner?eid=<?= $event_id ?>" method="post">
                    <div class="mb-3">
                        <label for="external_winner_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="external_winner_name" name="external_winner_name" placeholder="Enter name" required>
                    </div>
                    <div class="mb-3">
                        <label for="external_winner_college" class="form-label">College</label>
                        <input type="text" class="form-control" id="external_winner_college" name="external_winner_college" placeholder="Enter college" required>
                    </div>
                    <div class="mb-3">
                        <label for="external_winner_email" class="form-label">Email ID</label>
                        <input type="email" class="form-control lowercase" id="external_winner_email" name="external_winner_email" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label for="external_winner_position" class="form-label">Position</label>
                        <select class="form-select" name="external_winner_position" id="external_winner_position" required>
                            <option disabled selected value> -- select a position -- </option>
                            <option value="1">First</option>
                            <option value="2">Second</option>
                            <option value="3">Third</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="external_winner_submit">Add Winner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- External Winner input modal end -->

<div class="card mb-5 shadow">
    <div class="card-header text-center fs-5 bg-5 text-white">External Winner Certificates</div>
    <div class="card-body">
        <div class="text-center">
            <!-- add winner button -->
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#external_winner_input_form"><i class="fa fa-plus" aria-hidden="true"></i> Add Winner</button>
            <?php
            if (count($data_external_winners) > 0) :
                // show request all button
                if ($external_winner_request_all_btn) :
            ?>
                    <a href="script_external_winners/requestAllExternalWinners?eid=<?= $entry_external_winner['event_id']; ?>">
                        <button type="button" class="btn btn-warning me-2 loading_btn"><i class="fa fa-fast-forward" aria-hidden="true"></i> Request All</button>
                    </a>
                <?php
                endif;
                // show generate all button
                if ($external_winner_generate_all_btn) :
                ?>
                    <a href="script_external_winners/generateAllExternalWinners?eid=<?= $entry_external_winner['event_id']; ?>">
                        <button type="button" class="btn btn-success me-2 generate_btn"><i aria-hidden="true" class="fa fa-cogs"></i> Generate All</button>
                    </a>
                <?php
                endif;
                // show download all & send mail buttons
                if ($external_winner_download_all_btn) :
                ?>
                    <a href="script_external_winners/downloadAllExternalWinners?eid=<?= $entry_external_winner['event_id']; ?>">
                        <button type="button" class="btn btn-dark me-2"><i aria-hidden="true" class="fa fa-download"></i> Download All</button>
                    </a>
                    <a href="script_external_winners/pdfReport?eid=<?= $entry_external_winner['event_id']; ?>">
                        <button type="button" class="btn btn-success me-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generate Report</button>
                    </a>
                    <a href="script_external_winners/sendMailAllExternalWinners?eid=<?= $entry_external_winner['event_id']; ?>&uid=u">
                        <button type="button" class="btn btn-warning me-2 send_mail_btn"><i aria-hidden="true" class="fa fa-paper-plane"></i> Sent Mail</button>
                    </a>
                <?php
                endif;
                ?>
                <!-- show delete all button -->
                <a href="script_external_winners/deleteAllExternalWinners?eid=<?= $entry_external_winner['event_id']; ?>&uid=u" class="btn-del-all-external-winners">
                    <button type="button" class="btn btn-danger me-2"><i aria-hidden="true" class="fa fa-trash"></i> Delete All</button>
                </a>
            <?php endif; ?>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-hover table-bordered text-center">
                <thead class="table-dark">
                    <tr class="align-middle">
                        <th></th>
                        <th>Name</th>
                        <th>Email ID</th>
                        <th>College</th>
                        <th>Position</th>
                        <th>Certificate No.</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($data_external_winners) > 0) :
                        // numbering the entries
                        $count = 1;
                        foreach ($data_external_winners as $entry_external_winner) :
                    ?>
                            <tr class="align-middle">
                                <td><?= $count; ?></td>
                                <td><?= $entry_external_winner['entry_name']; ?></td>
                                <td><?= $entry_external_winner['entry_email']; ?></td>
                                <td><?= $entry_external_winner['entry_college']; ?></td>
                                <td>
                                    <?php
                                    if ($entry_external_winner['entry_position'] == 1) {
                                        echo "First";
                                    } elseif ($entry_external_winner['entry_position'] == 2) {
                                        echo "Second";
                                    } elseif ($entry_external_winner['entry_position'] == 3) {
                                        echo "Third";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($entry_external_winner['certificate_number'] == "") :
                                        echo "Not available";
                                    else :
                                        echo $entry_external_winner['certificate_number'];
                                    endif;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // show status
                                    if ($entry_external_winner['request_status'] == 0 && $entry_external_winner['approval_status'] == 0 && $entry_external_winner['generate_status'] == 0) {
                                        echo "<span class='text-warning'>Request not raised</span>";
                                    } elseif ($entry_external_winner['request_status'] == 1 && $entry_external_winner['approval_status'] == 0 && $entry_external_winner['generate_status'] == 0) {
                                        echo "<span class='text-primary'>Requested by " . $entry_external_winner['requested_by'] . " on " . $entry_external_winner['requested_at'] . "</span><br><span class='text-secondary'>Pending Approval</span>";
                                    } elseif ($entry_external_winner['request_status'] == 1 && $entry_external_winner['approval_status'] == 1 && $entry_external_winner['generate_status'] == 0) {
                                        echo "<span class='text-success'>Approved by " . $entry_external_winner['approved_by'] . " on " . $entry_external_winner['approved_at'] . "</span><br><span class='text-danger'>Certificate not generated</span>";
                                    } elseif ($entry_external_winner['request_status'] == 1 && $entry_external_winner['approval_status'] == 2 && $entry_external_winner['generate_status'] == 0) {
                                        echo "<span class='text-danger'>Requested by " . $entry_external_winner['requested_by'] . " on " . $entry_external_winner['requested_at'] . "<br>Rejected by " . $entry_external_winner['approved_by'] . " on " . $entry_external_winner['approved_at'] . "</span>";
                                    } elseif ($entry_external_winner['request_status'] == 1 && $entry_external_winner['approval_status'] == 1 && $entry_external_winner['generate_status'] == 1 && $entry_external_winner['mail_status'] == 0) {
                                        echo "<span class='text-success'>Approved by " . $entry_external_winner['approved_by'] . " on " . $entry_external_winner['approved_at'] . "<br>Certificate generated by " . $entry_external_winner['generated_by'] . " on " . $entry_external_winner['generated_at'] . "</span>";
                                    } elseif ($entry_external_winner['request_status'] == 1 && $entry_external_winner['approval_status'] == 1 && $entry_external_winner['generate_status'] == 1 && $entry_external_winner['mail_status'] == 1) {
                                        echo "<span class='text-success'>Approved by " . $entry_external_winner['approved_by'] . " on " . $entry_external_winner['approved_at'] . "<br>Certificate generated by " . $entry_external_winner['generated_by'] . " on " . $entry_external_winner['generated_at'] . "<br>Mail sent by " . $entry_external_winner['mailed_by'] . " on " . $entry_external_winner['mailed_at'] . "</span>";
                                    } elseif ($entry_external_winner['request_status'] == 1 && $entry_external_winner['approval_status'] == 1 && $entry_external_winner['generate_status'] == 1 && $entry_external_winner['mail_status'] == 2) {
                                        echo "<span class='text-success'>Approved by " . $entry_external_winner['approved_by'] . " on " . $entry_external_winner['approved_at'] . "<br>Certificate generated by " . $entry_external_winner['generated_by'] . " on " . $entry_external_winner['generated_at'] . "</span><br><span class='text-danger'>Error in sending mail</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <!-- show request button -->
                                    <?php if ($entry_external_winner['request_status'] == 0) : ?>
                                        <a href="script_external_winners/requestSingleExternalWinner?ewid=<?= $entry_external_winner['entry_id']; ?>&eid=<?= $entry_external_winner['event_id']; ?>">
                                            <button type="button" class="btn btn-sm btn-warning me-2 mt-2 loading_btn"><i class="fa fa-forward" aria-hidden="true"></i> Request</button>
                                        </a>
                                    <?php endif;
                                    // show generate button
                                    if ($entry_external_winner['approval_status'] == 1 && $entry_external_winner['generate_status'] == 0) : ?>
                                        <a href="script_external_winners/generateSingleExternalWinner?ewid=<?= $entry_external_winner['entry_id']; ?>&eid=<?= $entry_external_winner['event_id']; ?>">
                                            <button type="button" class="btn btn-sm btn-success me-2 mt-2 generate_btn"><i class="fa fa-cog" aria-hidden="true"></i> Generate</button>
                                        </a>
                                    <?php endif;
                                    // show download and send mail buttons
                                    if ($entry_external_winner['generate_status'] == 1) : ?>
                                        <a href="certificates/<?php echo $event_id; ?>/external_winners/<?php echo $entry_external_winner['certificate_number']; ?>.jpg" download>
                                            <button type="button" class="btn btn-sm btn-dark me-2 mt-2"><i aria-hidden="true" class="fa fa-download"></i> Download</button>
                                        </a>
                                        <a href="script_external_winners/sendMailSingleExternalWinner?ewid=<?= $entry_external_winner['entry_id']; ?>&eid=<?= $entry_external_winner['event_id']; ?>&uid=u">
                                            <button type="button" class="btn btn-sm btn-warning me-2 mt-2 send_mail_btn"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Mail</button>
                                        </a>
                                    <?php endif; ?>
                                    <!-- show delete button -->
                                    <a href="script_external_winners/deleteSingleExternalWinner?ewid=<?= $entry_external_winner['entry_id']; ?>&eid=<?= $entry_external_winner['event_id']; ?>&uid=u" class="btn-del-single-external-winner">
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