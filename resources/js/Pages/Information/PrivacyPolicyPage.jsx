import React from 'react';
import { Head } from '@inertiajs/react';

const PrivacyPolicyPage = ({ title = '', text = '' }) => {
	return (
		<>
			<Head>
				<title>{title}</title>
			</Head>
			<h1 className='title container page-content__title'>{title}</h1>
			<div className='container text-content' dangerouslySetInnerHTML={{ __html: text }}></div>
		</>
	);
};

export default PrivacyPolicyPage;
