<div class="list_tables">
	<div class="add_button">
		<?php maintenance_detail_add_link('subjects', $_SESSION['userPermmissions']) ?>
	</div>
	<?php $uri = new \CodeIgniter\HTTP\URI(current_url()); ?>
	<div class="table-responsive">
		<table class="table stripe"  id="myTable">
			<thead class="thead-dark">
				<tr class="text-center">
					<th>#</th>
					<th>Subject Code</th>
					<th>Subject</th>
					<th>Hours</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $cnt = 1; ?>
				<?php foreach($subject as $subjects): ?>
					<tr class="text-center">
						<th scope="row"><?= $cnt++ ?></th>
						<td><?= $subjects['code'] ?></td>
						<td><?= $subjects['subject'] ?></td>
						<td><?= $subjects['required_hrs'] ?></td>
						<td><?= ($subjects['status'] == 'a') ? 'active':'inactive' ?></td>
						<td class="text-center">
							<a class="btn btn-success btn-sm" title="edit" href='<?= base_url('subjects/edit/'.$subjects['id']); ?>'><i class="far fa-edit"></i></a>
							<?php if($subjects['status'] == 'a'):?>
								<a class="btn btn-danger btn-sm remove" onclick=" confirmUpdateStatus('<?= base_urL('subjects/inactive/')?>',<?=$subjects['id']?>,'d')" title="deactivate"><i class="fas fa-archive"></i></a>
							<?php else:?>
								<a class="btn btn-info btn-sm remove" onclick=" confirmUpdateStatus('<?= base_urL('subjects/active/')?>',<?=$subjects['id']?>,'a')" title="activate"><i class="fas fa-archive"></i></a>
							<?php endif;?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>