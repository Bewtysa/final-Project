<?php
    // Include database connection
    require_once "../config/bd.php";

    // Fetch all bookings from database
    $stmt = $conn->query("SELECT * FROM booking");
    $bookings = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include necessary meta tags, CSS, and JavaScript libraries -->
</head>
<body>
    <!-- Display booking list -->
    <table>
        <thead>
            <tr>
                <!-- Table headers -->
            </tr>
        </thead>
        <tbody>
            <?php foreach($bookings as $booking): ?>
                <tr>
                    <!-- Display booking details -->
                    <td><?php echo $booking['id']; ?></td>
                    <td><?php echo $booking['name']; ?></td>
                    <!-- Display other booking details -->
                    <td>
                        <!-- Button to trigger cancel confirmation modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal<?php echo $booking['id']; ?>">Cancel</button>
                        <!-- Cancel confirmation modal -->
                        <div class="modal fade" id="cancelModal<?php echo $booking['id']; ?>" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                            <!-- Modal content -->
                            <div class="modal-dialog">
                                <!-- Modal header -->
                                <div class="modal-header">
                                    <!-- Modal title -->
                                    <h5 class="modal-title" id="cancelModalLabel">Cancel Booking</h5>
                                    <!-- Close button -->
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <!-- Confirmation message -->
                                    Are you sure you want to cancel this booking?
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <!-- Cancel button -->
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <!-- Confirm cancel button -->
                                    <a href="cancel_booking.php?id=<?php echo $booking['id']; ?>" class="btn btn-danger">Cancel Booking</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
