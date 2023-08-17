import React from 'react';
import { Head } from '@inertiajs/react';

import MunicipalAreaList from '../../Components/Maintenance/MunicipalAreaList';

const MunicipalAreasOverviewPage = ({ title = '', routeName = '', municipalAreas = [] }) => {
	return (
		<>
			<Head>
				<title>{title}</title>
			</Head>
			<h1 className='title page-content__title container'>{title}</h1>
			{Boolean(municipalAreas.length) && (
				<MunicipalAreaList areas={municipalAreas} routeName={routeName} className='container' />
			)}
		</>
	);
};

export default MunicipalAreasOverviewPage;
