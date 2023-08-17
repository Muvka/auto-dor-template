import React from 'react';
import { Head } from '@inertiajs/react';
import ClosedSectionList from '../../Components/Maintenance/ClosedSectionList';

const ClosedSectionPage = ({ title = '', sections = [] }) => {
	return (
		<>
			<Head>
				<title>{title}</title>
			</Head>
			<h1 className="title container page-content__title">{title}</h1>
			{Boolean(sections.length) && (
				<ClosedSectionList sections={sections} className="container" />
			)}
		</>
	);
};

export default ClosedSectionPage;
