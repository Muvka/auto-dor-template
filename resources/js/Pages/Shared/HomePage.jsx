import React from 'react';
import { Head } from '@inertiajs/react';

import ComplexLayout from '../../Layouts/СomplexLayout';
import SiteSectionList from '../../Components/Shared/SiteSectionList';
import LinksWidget from '../../Components/Shared/LinksWidget';
import QuestionWidget from '../../Components/Maintenance/QuestionWidget';
import blinkerIconId from '../../../images/shared/icons/icon-blinker.svg';
import vkontakteIconId from '../../../images/shared/icons/icon-vkontakte.svg';
import telegramIconId from '../../../images/shared/icons/icon-telegram.svg';
import callingIconId from '../../../images/shared/icons/icon-calling.svg';

const icons = {
	vkontakte: vkontakteIconId,
	telegram: telegramIconId,
	calling: callingIconId,
	blinker: blinkerIconId,
};

const HomePage = ({ title = '', siteSections = [], contacts: contactsProp = [] }) => {
	const contacts = contactsProp.map(contact => {
		return {
			...contact,
			icon: icons[contact.icon],
		};
	});
	return (
		<>
			<Head>
				<title>{title}</title>
			</Head>
			<h1 className='visually-hidden'>{title}</h1>
			<div className='page-content__grid container'>
				{Boolean(siteSections.length) &&
					<SiteSectionList sections={siteSections} className='page-content__full-width-block' />}
				<LinksWidget title='Наши соцсети:' links={contacts} />
				<LinksWidget title='Нужна помощь?' description='Нажмите, чтобы позвонить 112' links={[{
					id: 'emergency',
					label: 'Позвонить в экстренную службу',
					icon: icons.blinker,
					danger: true,
					url: 'tel:112',
				}]} />
				<QuestionWidget className='page-content__full-width-block' />
			</div>
		</>
	);
};

HomePage.layout = (page) => <ComplexLayout children={page} />;

export default HomePage;
