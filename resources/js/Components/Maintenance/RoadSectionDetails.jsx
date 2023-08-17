import React, { useId } from 'react';
import clsx from 'clsx';

import PrintButton from '../Shared/PrintButton';
import DescriptionList from '../Shared/DescriptionList';
import ContactLine from '../Contacts/ContactLine';
import weatherIconId from '../../../images/shared/icons/icon-weather.svg';

const RoadSectionDetails = (
	{
		name = '',
		address = '',
		head = '',
		dispatcherTelephone = '',
		serviceTelephone = '',
		telephones = [],
		email: sectionEmail = '',
		contactEmail = '',
		maintenanceUrl = '',
		repairUrl = '',
		monitoringUrl = '',
		informationUrl = '',
		weatherUrl = '',
		className = '',
	},
) => {
	const titleId = useId();

	return (
		<section className={clsx('road-section-details', className)} aria-labelledby={titleId}>
			<div className='road-section-details__contacts'>
				<h2 id={titleId} className='title title--small road-section-details__title'>
					{name}
				</h2>
				<DescriptionList className='road-section-details__list'>
					<DescriptionList.Item term='Адрес:' definition={address} />
					<DescriptionList.Item term='Руководитель ДУ:' definition={head} />
					{Boolean(serviceTelephone) && (
						<DescriptionList.Item term='Телефон круглосуточной дисп.службы:'>
							<ContactLine type='tel' className='road-section-details__contact'>
								{serviceTelephone}
							</ContactLine>
						</DescriptionList.Item>
					)}
					{Boolean(dispatcherTelephone) && (
						<DescriptionList.Item term='Телефон автодиспетчера:'>
							<ContactLine type='tel' className='road-section-details__contact'>
								{dispatcherTelephone}
							</ContactLine>
						</DescriptionList.Item>
					)}
					{telephones.map((telephone) => (
						<DescriptionList.Item key={telephone.id} term={telephone.name}>
							<ContactLine type='tel' className='road-section-details__contact'>
								{telephone.number}
							</ContactLine>
						</DescriptionList.Item>
					))}
					{Boolean(sectionEmail) && (
						<DescriptionList.Item term='E-mail ДУ:'>
							<ContactLine type='email' className='road-section-details__contact'>
								{sectionEmail}
							</ContactLine>
						</DescriptionList.Item>
					)}
					{Boolean(contactEmail) && (
						<DescriptionList.Item term='E-mail:'>
							<ContactLine type='email' className='road-section-details__contact'>
								{contactEmail}
							</ContactLine>
						</DescriptionList.Item>
					)}
				</DescriptionList>
			</div>
			<PrintButton className='road-section-details__print' />
			<div className='road-section-details__links'>
				{Boolean(maintenanceUrl) && (
					<a href={maintenanceUrl} target='_blank' rel='nofollow noopener noreferrer'
					   className='button button--accent'>Показать на карте</a>
				)}
				{Boolean(repairUrl) && (
					<a href={repairUrl} target='_blank' rel='nofollow noopener noreferrer'
					   className='button button--accent'>Показать на карте</a>
				)}
				{Boolean(monitoringUrl) && (
					<a href={monitoringUrl} target='_blank' rel='nofollow noopener noreferrer'
					   className='button button--accent'>Интерактивная карта</a>
				)}
				{Boolean(informationUrl) && (
					<a href={informationUrl} target='_blank' rel='nofollow noopener noreferrer'
					   className='button button--accent'>
						Информация по содержанию и строительству
					</a>
				)}
				{Boolean(weatherUrl) && (
					<a href={weatherUrl} target='_blank' rel='nofollow noopener noreferrer'
					   className='button button--flex'>
						<svg width='24' height='24' className='button__icon' aria-hidden='true'>
							<use xlinkHref={`#${weatherIconId}`} />
						</svg>
						Погода в районе
					</a>
				)}
			</div>
		</section>
	);
};

export default RoadSectionDetails;
