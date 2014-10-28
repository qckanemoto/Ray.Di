<?php

namespace Ray\Di;

class FakeAopModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(FakeAopInterface::class)->to(FakeAop::class);
        $this->bindInterceptors(
            $this->matcher->any(),
            $this->matcher->any(),
            [FakeDoubleInterceptor::class]
        );
    }
}
