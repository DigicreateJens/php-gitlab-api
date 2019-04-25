<?php

namespace Gitlab\Api;

class Events extends AbstractApi
{

    /**
     * @param array $parameters (
     *
     * @return mixed
     */
    public function all(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();

        $resolver->setDefined('action')
                 ->setAllowedValues(
                     'action',
                     [
                         'created',
                         'updated',
                         'closed',
                         'reopened',
                         'pushed',
                         'commented',
                         'merged',
                         'joined',
                         'left',
                         'destroyed',
                         'expired',
                     ]
                 );
        $resolver->setDefined('target_type')
                 ->setAllowedValues(
                     'target_type',
                     [
                         'issue',
                         'milestone',
                         'merge_request',
                         'note',
                         'project',
                         'snippet',
                         'user',
                     ]
                 );
        $resolver->setDefined('before');
        $resolver->setDefined('after');
        $resolver->setDefined('per_page');

        $resolver->setDefined('sort')
                 ->setAllowedValues('sort', ['asc', 'desc']);

        return $this->get('events', $resolver->resolve($parameters));
    }

}