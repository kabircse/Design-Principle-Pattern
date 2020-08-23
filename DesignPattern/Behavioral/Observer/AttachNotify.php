<?php
interface IObservable
{
    public function attach(IObserver $oObserver);
    public function detach(IObserver $oObserver);
    public function notify();
} 
interface IObserver
{
    public function update(IObservable $oObservable);
}
 
class Settings implements IObservable
{
    private $aSettings;
    private $aObserverLists;     
    public function attach(IObserver $oObserver)
    {
        $iIndex = count($this->aObserverLists);
        $this->aObserverLists[$iIndex] = $oObserver;
    }     
    public function detach(IObserver $oObserver)
    {
        // Insert logic for removing Observer in your list here...
    }     
    public function notify()
    {
        foreach($this->aObserverLists as $oObserver) {
            $oObserver->update($this);
        }
    }     
    public function getSettings()
    {
        return $this->aSettings;
    }
     
    public function setSettings($aNewSettings)
    {
        $this->aSettings= $aNewSettings;
    }
}
 
class SlideshowWidget implements InstagramWidgetInterface, IObserver
{
    private $oEffectBehavior; 
    public function __construct(EffectBehaviorInterface $oEffectBehavior)
    {
        $this->oEffectBehavior = $oEffectBehavior;
    } 
    public function update(IObservable $oObservable)
    {
        echo 'I am ' . __CLASS__ . ' and I was updated by ' . get_class($oObservable); 
        var_dump($oObservable->getSettings());
    } 
    public function getWidget()
    {  
        return 'SlideshowWidget -> ' . 'Effects: ' . $this->oEffectBehavior->applyEffect();
    }
}

class Simulator
{
    public function index()
    {
        $oSettings = new Settings();
        $aDummySettings = ['ui_settings' => 'Slideshow', 'size' => false, 'effects' => 'Fade'];
        $oSettings->setSettings(aDummySettings);
 
        $oWidgetFactory = new InstagramWidgetFactory();
        $oFirstWidget = $oWidgetFactory->generateWidget($oSettings->getSettings());
        $oSettings->attach($oFirstWidget);
         
        $aDummySettings2 = ['ui_settings' => 'Slideshow', 'size' => false, 'effects' => '3d'];
        $oSettings->setSettings(aDummySettings);
        $oSettings->notify();
    }
}

/*
Output:
I am SlideshowWidget and I was updated by Settings
['ui_settings' => 'Slideshow', 'size' => false, 'effects' => '3d']
*/
