import React, { useId } from 'react';
import { usePage } from '@inertiajs/react';
import clsx from 'clsx';

import DocumentsSearchForm from './DocumentsSearchForm';
import DocumentFileList from '../Maintenance/DocumentFileList';
import DocumentDirectoryForm from './DocumentDirectoryForm';
import UploadDocumentForm from './UploadDocumentForm';

const DocumentManagement = ({ className = '' }) => {
	const { isSearch = false, files = [] } = usePage().props;
	const titleId = useId();
	const documentListTitle = isSearch ? 'Результаты поиска' : 'Список файлов';

	return (
		<section className={clsx('document-management', className)} aria-labelledby={titleId}>
			<h2 id={titleId} className='visually-hidden'>Управление документами</h2>
			<DocumentsSearchForm className='document-management__search' />
			<DocumentFileList title={documentListTitle} hiddenTitle={!isSearch} files={files}
					  emptyMessage={isSearch ? 'По Вашему запросу ничего не найдено' : undefined}
					  className='document-management__file-list' />
			{!isSearch && (
				<>
					<DocumentDirectoryForm className='document-management__create-directory' />
					<UploadDocumentForm className='document-management__upload-files' />
				</>
			)}
		</section>
	);
};

export default DocumentManagement;
