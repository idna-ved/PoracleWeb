
                <!-- Content Row -->

                <div class="tab-content mb-5" id="pills-tab-homeContent">

                    <?php if (@$disable_raids <> "True") { ?>
                    <div class="tab-pane fade show active" id="pills-raids" role="tabpanel" aria-labelledby="pills-raids-tab">

                        <!-- Top Quick Links  -->
                        <?php include "include/toplinks.php"; ?>

                        <!-- Page Heading -->
                        <div class="text-center">
                            <div class="breadcrumb justify-content-center">
                                <h1 class="h3 mb-0 text-gray-800 "><?php echo i8ln("EGGS & RAIDS TRACKED"); ?></h1>
                            </div>
                        </div>

                        <div class="row">
                            <?php
                                if ($all_raid_cleaned == '1') {
                                ?>
                            <div class="col">
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <?php echo i8ln("Cleaning activated on"); ?>
                                    <strong><?php echo i8ln("ALL Raids/Eggs"); ?></strong>!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="row">
                            <div class="row no-gutters align-items-center p-3">
                                <a href="./?type=add&page=raid" class="btn btn-success btn-icon-split mr-2 mt-1">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text"><?php echo i8ln("ADD"); ?></span>
                                </a>
                                <a href="#" class="btn btn-danger btn-icon-split mr-2 mt-1" data-toggle="modal"
                                    data-target="#deleteAllRaidEggsModal">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                    <span class="text"><?php echo i8ln("DELETE ALL"); ?></span>
				</a>
                                <a href="#" class="btn btn-primary btn-icon-split mr-2 mt-1" data-toggle="modal"
                                    data-target="#DistanceRaidsModal">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-crosshairs"></i>
                                    </span>
                                    <span class="text"><?php echo i8ln("UPDATE DISTANCE"); ?></span>
                                </a>
                            </div>
                        </div>

                        <!-- DELETE ALL RAID/EGGS Modal -->
                        <div class="modal fade" id="deleteAllRaidEggsModal" tabindex="-1" role="dialog"
                            aria-labelledby="deleteAllRaidEggsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteAllRaidEggsModalLabel">
                                            <?php echo i8ln("Delete ALL Raid/Eggs?"); ?>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo i8ln("This will delete all your Eggs & Raids Alarms and cannot be undone, are you sure ?"); ?>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="./actions/raids.php?action=delete_all_raids"
                                            class="btn btn-danger"><?php echo i8ln("DELETE"); ?></a>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal"><?php echo i8ln("CANCEL"); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- UPDATE RAIDS_EGGS DISTANCE MODAL -->
                        <div class="modal fade" id="DistanceRaidsModal" tabindex="-1" role="dialog"
                            aria-labelledby="DistanceRaidsModal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                        <?php include "./modal/distance_raids_modal.php"; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Content Row -->
                        <div class="row">

                            <?php

                                // Show Eggs & Raids

                                $sql = "select * FROM egg WHERE id = '" . $_SESSION['id'] . "' AND profile_no = '" . $_SESSION['profile'] . "' ORDER BY level";
                                $result = $conn->query($sql);

                                while ($row = $result->fetch_assoc()) {

                                    // Build a Unique Index
                                    $egg_unique_id = "raid_" . $row['uid'];

                                ?>
                            <!-- Card -->
                            <div class="col-lg-3 col-md-3 col-sm-4 col-6 mb-4">
                                <div class="card border-top-success shadow h-100 py-2">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col">
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">
                                                    <img width=50 loading=lazy
                                                        src='<?php echo $imgUrl . "/egg" . $row['level'] . ".png"; ?>'>
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center mt-2">
                                                    <?php echo i8ln("Eggs"); ?> <?php echo $row['level']; ?>
                                                </div>
                                                <ul class="list-group mt-2">

                                                    <?php

                                                            if ($row['distance'] <> '0') {
                                                            ?>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        <?php echo i8ln("DISTANCE"); ?>
                                                        <?php if ( @$distance_map <> "True" ) { ?>
                                                        <span
                                                            class="badge badge-primary badge-pill"><?php echo $row['distance']; ?>
                                                        </span>
                                                        <?php } else { ?>
                                                        <a href="#DistanceShowEggs" data-toggle="modal" data-target="#DistanceShowEggs_<?php echo $row['distance']; ?>">
                                                        <span
                                                            class="badge badge-primary badge-pill"><?php echo $row['distance']; ?>
                                                            <i class="fas fa-map-marked-alt"></i>
                                                        </span>
                                                        </a>
                                                        <?php } ?>
                                                    </li>

                                                    <!-- SHOW DISTANCE Modal -->
                                                    <div class="modal fade" id="DistanceShowEggs_<?php echo $row['distance']; ?>" tabindex="-1" role="dialog"
                                                        aria-labelledby="DistanceShowEggsTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <?php include "./modal/distance_show_modal.php"; ?>
                                                                </div>
                                                            </div>
                                                        </div>
						    </div>

                                                    <?php
                                                            }
                                                            if ($row['clean'] == '1' && $all_raid_cleaned == '0') {
                                                            ?>
                                                    <div class="mb-2">
                                                        <span
                                                            class="badge badge-pill badge-info w-100"><?php echo i8ln("Cleaning Activated"); ?></span>
                                                    </div>
                                                    <?php
                                                            }
                                                            if (isset($allowed_templates["eggs"])) {
                                                            ?>
                                                    <div class="mb-2">
                                                        <span class="badge badge-pill badge-info w-100">Template: <?php echo array_key_exists($row['template'], $allowed_templates["eggs"]) ? $allowed_templates["eggs"][$row['template']] : 'UNKNOWN'; ?></span>
                                                    </div>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <div class="row">
                                                <a href="#" class="btn btn-danger btn-circle btn-md m-1"
                                                    data-toggle="modal"
                                                    data-target="#<?php echo $egg_unique_id ?>DeleteModal">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <a href="#" class="btn btn-success btn-circle btn-md m-1"
                                                    data-toggle="modal"
                                                    data-target="#<?php echo $egg_unique_id ?>Modal">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- EDIT EGG Modal -->
                            <div class="modal fade" id="<?php echo $egg_unique_id ?>Modal" tabindex="-1" role="dialog"
                                aria-labelledby="<?php echo $egg_unique_id ?>ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <?php include "./modal/edit_eggs_modal.php"; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- DELETE EGG Modal -->
                            <div class="modal fade" id="<?php echo $egg_unique_id ?>DeleteModal" tabindex="-1"
                                role="dialog" aria-labelledby="<?php echo $egg_unique_id ?>DeleteModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <?php include "./modal/delete_eggs_modal.php"; ?>
                                    </div>
                                </div>
                            </div>

                            <?php
                                }

				$sql = "select * FROM raid WHERE id = '" . $_SESSION['id'] . "' AND profile_no = '" . $_SESSION['profile'] . "' 
					AND pokemon_id = 9000 ORDER BY level";
                                $result = $conn->query($sql);

                                while ($row = $result->fetch_assoc()) {

                                    // Build a Unique Index
                                    $raid_unique_id = "raid_" . $row['uid'];

                                ?>

                            <!-- Card -->
                            <div class="col-lg-3 col-md-3 col-sm-4 col-6 mb-4">
                                <div class="card border-top-warning shadow h-100 py-2">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col">
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">
                                                    <img width=50 loading=lazy
                                                        src='<?php echo "./img/raid_" . $row['level'] . ".png"; ?>'>
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center mt-2">
                                                    <?php echo i8ln("Raids"); ?> <?php echo $row['level']; ?>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <?php

                                                            if ($row['distance'] <> '0') {
                                                            ?>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        <?php echo i8ln("DISTANCE"); ?>
                                                        <?php if ( @$distance_map <> "True" ) { ?>
                                                        <span
                                                            class="badge badge-primary badge-pill"><?php echo $row['distance']; ?>
                                                        </span>
                                                        <?php } else { ?>
                                                        <a href="#DistanceShowPokemons" data-toggle="modal" data-target="#DistanceShowPokemons_<?php echo $row['distance']; ?>">
                                                        <span
                                                            class="badge badge-primary badge-pill"><?php echo $row['distance']; ?>
                                                            <i class="fas fa-map-marked-alt"></i>
                                                        </span>
                                                        </a>
                                                        <?php } ?>
                                                    </li>

                                                    <!-- SHOW DISTANCE Modal -->
                                                    <div class="modal fade" id="DistanceShowPokemons_<?php echo $row['distance']; ?>" tabindex="-1" role="dialog"
                                                        aria-labelledby="DistanceShowPokemonsTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <?php include "./modal/distance_show_modal.php"; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                            }
                                                            if ($row['clean'] == '1' && $all_raid_cleaned == '0') {
                                                            ?>
                                                    <div class="mb-2">
                                                        <span
                                                            class="badge badge-pill badge-info w-100"><?php echo i8ln("Cleaning Activated"); ?></span>
                                                    </div>
						    <?php 
                                                            } 
                                                            if (isset($allowed_templates["raids"])) {
                                                            ?>
                                                    <div class="mt-1">
                                                        <span class="badge badge-pill badge-info w-100">Template: <?php echo array_key_exists($row['template'], $allowed_templates["raids"]) ? $allowed_templates["raids"][$row['template']] : 'UNKNOWN'; ?></span>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <div class="row">
                                                <a href="#" class="btn btn-danger btn-circle btn-md m-1"
                                                    data-toggle="modal"
                                                    data-target="#<?php echo $raid_unique_id ?>DeleteModal">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <a href="#" class="btn btn-success btn-circle btn-md m-1"
                                                    data-toggle="modal"
                                                    data-target="#<?php echo $raid_unique_id ?>Modal">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- EDIT Raid Modal -->
                            <div class="modal fade" id="<?php echo $raid_unique_id ?>Modal" tabindex="-1" role="dialog"
                                aria-labelledby="<?php echo $raid_unique_id ?>ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <?php include "./modal/edit_raids_modal.php"; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- DELETE RAID Modal -->
                            <div class="modal fade" id="<?php echo $raid_unique_id ?>DeleteModal" tabindex="-1"
                                role="dialog" aria-labelledby="<?php echo $raid_unique_id ?>DeleteModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <?php include "./modal/delete_raids_modal.php"; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }

				$sql = "select * FROM raid WHERE id = '" . $_SESSION['id'] . "' and profile_no = '" . $_SESSION['profile'] . "'  
					AND pokemon_id <> 9000 ORDER BY pokemon_id";
                                $result = $conn->query($sql);

                                while ($row = $result->fetch_assoc()) {

                                    // Build a Unique Index
                                    $raid_unique_id = "raid_" . $row['uid'];
                                    $pokemon_name = get_mons($row['pokemon_id']);

                                ?>
                            <!-- Card -->
                            <div class="col-lg-3 col-md-3 col-sm-4 col-6 mb-4">
                                <div class="card border-top-danger shadow h-100 py-2">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col">
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">
                                                    <img width=50 loading=lazy
                                                        src='<?php echo $imgUrl . "/pokemon_icon_" . str_pad($row['pokemon_id'], 3, "0", STR_PAD_LEFT) . "_00.png"; ?>'>
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center mt-2">
                                                    <?php echo $pokemon_name; ?>
                                                </div>
                                                <div class="mt-2 text-center">

                                                    <?php

                                                            if ($row['distance'] <> '0') {
                                                            ?>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        <?php echo i8ln("DISTANCE"); ?>
                                                        <?php if ( @$distance_map <> "True" ) { ?>
                                                        <span
                                                            class="badge badge-primary badge-pill"><?php echo $row['distance']; ?>
                                                        </span>
                                                        <?php } else { ?>
                                                        <a href="#DistanceShowRaidMons" data-toggle="modal" data-target="#DistanceShowRaidMons_<?php echo $row['distance']; ?>">
                                                        <span
                                                            class="badge badge-primary badge-pill"><?php echo $row['distance']; ?>
                                                            <i class="fas fa-map-marked-alt"></i>
                                                        </span>
                                                        </a>
                                                        <?php } ?>
                                                    </li>

                                                    <!-- SHOW DISTANCE Modal -->
                                                    <div class="modal fade" id="DistanceShowRaidMons_<?php echo $row['distance']; ?>" tabindex="-1" role="dialog"
                                                        aria-labelledby="DistanceShowRaidMonsTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <?php include "./modal/distance_show_modal.php"; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                            }
                                                            if ($row['clean'] == '1' && $all_raid_cleaned == '0') {
                                                            ?>
                                                    <div class="mb-2">
                                                        <span
                                                            class="badge badge-pill badge-info w-100"><?php echo i8ln("Cleaning Activated"); ?></span>
                                                    </div>
                                                    <?php
                                                            }
                                                            if (isset($allowed_templates["raids"])) {
                                                            ?>
                                                    <div class="mt-1">
                                                        <span class="badge badge-pill badge-info w-100">Template: <?php echo array_key_exists($row['template'], $allowed_templates["raids"]) ? $allowed_templates["raids"][$row['template']] : 'UNKNOWN'; ?></span>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <div class="row">
                                                <a href="#" class="btn btn-danger btn-circle btn-md m-1"
                                                    data-toggle="modal"
                                                    data-target="#<?php echo $raid_unique_id ?>DeleteModal">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <a href="#" class="btn btn-success btn-circle btn-md m-1"
                                                    data-toggle="modal"
                                                    data-target="#<?php echo $raid_unique_id ?>Modal">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- EDIT Monster Raid Modal -->
                            <div class="modal fade" id="<?php echo $raid_unique_id ?>Modal" tabindex="-1" role="dialog"
                                aria-labelledby="<?php echo $raid_unique_id ?>ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <?php include "./modal/edit_raids_modal.php"; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- DELETE Monster RAID Modal -->
                            <?php $pokemon_name=get_mons($row['pokemon_id']); ?>
                            <div class="modal fade" id="<?php echo $raid_unique_id ?>DeleteModal" tabindex="-1"
                                role="dialog" aria-labelledby="<?php echo $raid_unique_id ?>DeleteModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <?php include "./modal/delete_monster_raids_modal.php"; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                                ?>

                        </div>

                    </div>
                    <?php
                    } // End of Raids Disable 
                    ?>

