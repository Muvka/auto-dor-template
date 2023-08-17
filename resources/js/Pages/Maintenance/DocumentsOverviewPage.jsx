import React from 'react';
import { Head } from '@inertiajs/react';

import DocumentManagement from '../../Components/Maintenance/DocumentManagement';

const DocumentsOverviewPage = ({ title = '' }) => {
	return (
		<>
			<Head>
				<title>{title}</title>
			</Head>
			<h1 className='title container page-content__title'>{title}</h1>
			<DocumentManagement className='container' />
		</>
	);
};

export default DocumentsOverviewPage;
