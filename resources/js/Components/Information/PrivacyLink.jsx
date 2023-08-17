import React from 'react';
import clsx from 'clsx';

const PrivacyLink = ({ className = '' }) => {
	return (
		<p className={clsx('privacy-link', className)}>
			Нажимая на кнопку, вы соглашаетесь&nbsp;с{' '}
			<a href={route('client.information.privacy')} target='_blank' className='privacy-link__link'>
				Условиями обработки персональных данных
			</a>
		</p>
	);
};

export default PrivacyLink;
