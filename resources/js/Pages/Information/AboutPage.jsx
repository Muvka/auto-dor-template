import React from 'react';
import { Head } from '@inertiajs/react';

import AboutCompany from '../../Components/Information/AboutCompany';

const AboutPage = ({ title = 'О компании' }) => {
	return (
		<>
			<Head>
				<title>{title}</title>
			</Head>
			<h1 className='title container page-content__title'>{title}</h1>
			<AboutCompany className='container' />
		</>
	);
};

export default AboutPage;
