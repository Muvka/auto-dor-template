import React, { useEffect } from 'react';
import { useForm, usePage } from '@inertiajs/react';

import FileInput from '../Shared/FileInput';
import clsx from 'clsx';
import FormField from '../Shared/FormField';
import { partialKeys } from '../../Helpers';

const fileAccept = [
	'application/pdf',
	'application/msword',
	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	'text/csv',
	'application/vnd.ms-excel',
	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
];

const UploadDocumentForm = ({ className = '' }) => {
	const { path = '' } = usePage().props;
	const { data, setData, post, processing, errors, clearErrors, reset, progress } = useForm({
		documents: [],
	});

	useEffect(() => {
		if (data.documents.length) {
			post(route('client.maintenance.documents.upload', path), {
				only: ['files', 'errors'],
				preserveScroll: true,
				forceFormData: true,
				onSuccess: () => {
					reset();
				},
			});
		}
	}, [data.documents]);

	return (
		<div className={clsx('form', className)}>
			<FormField error={partialKeys(errors).documents}>
				<FileInput label='Загрузить файлы' disabled={processing} multiple accept={fileAccept.join(', ')}
						   invalid={Boolean(partialKeys(errors).documents)}
						   onChange={(documents) => {
							   clearErrors('documents');
							   setData('documents', documents);
						   }} />
			</FormField>
			{Boolean(progress) && (
				<p className='document-management__progress'>{progress.percentage}%</p>
			)}
		</div>
	);
};

export default UploadDocumentForm;
